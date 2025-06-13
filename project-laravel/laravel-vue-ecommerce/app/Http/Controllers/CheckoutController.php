<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Helpers\Cart;
use App\Mail\NewOrderEmail;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $customer = $user->customer;
        if (!$customer->billingAddress || !$customer->shippingAddress) {
            return redirect()->route('profile')->with('error', 'Please provide your address details first.');
        }

        [$products, $cartItems] = Cart::getProductsAndCartItems();

        $orderItems = [];
        $totalPrice = 0;

        DB::beginTransaction();

        try {
            // Validate product quantities
            foreach ($products as $product) {
                $quantity = $cartItems[$product->id]['quantity'];
                if ($product->quantity !== null && $product->quantity < $quantity) {
                    $message = match ($product->quantity) {
                        0 => 'The product "' . $product->title . '" is out of stock',
                        1 => 'There is only one item left for product "' . $product->title,
                        default => 'There are only ' . $product->quantity . ' items left for product "' . $product->title,
                    };
                    return redirect()->back()->with('error', $message);
                }
            }

            // Calculate total price and prepare order items
            foreach ($products as $product) {
                $quantity = $cartItems[$product->id]['quantity'];
                $totalPrice += $product->price * $quantity;
                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price
                ];

                // Update product quantity
                if ($product->quantity !== null) {
                    $product->quantity -= $quantity;
                    $product->save();
                }
            }

            // Create Order
            $orderData = [
                'total_price' => $totalPrice,
                'status' => OrderStatus::Paid->value, // Mark as Paid since no payment gateway
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ];
            $order = Order::create($orderData);

            // Create Order Items
            foreach ($orderItems as $orderItem) {
                $orderItem['order_id'] = $order->id;
                OrderItem::create($orderItem);
            }

            // Create Payment
            $paymentData = [
                'order_id' => $order->id,
                'amount' => $totalPrice,
                'status' => PaymentStatus::Paid->value, // Mark as Paid since no payment gateway
                'type' => 'none', // No payment gateway used
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ];
            Payment::create($paymentData);

            DB::commit();

            // Clear cart
            CartItem::where('user_id', $user->id)->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical(__METHOD__ . ' method failed: ' . $e->getMessage());
            return redirect()->route('checkout.failure')->with('error', 'Checkout failed: ' . $e->getMessage());
        }

        // Send emails outside the transaction
        try {
            $adminUsers = User::where('is_admin', 1)->get();
            foreach ([...$adminUsers, $order->user] as $recipient) {
                Mail::to($recipient)->send(new NewOrderEmail($order, (bool)$recipient->is_admin));
            }
        } catch (\Exception $e) {
            Log::warning('Email sending failed during checkout: ' . $e->getMessage());
            // Continue to success even if email fails
        }

        return redirect()->route('checkout.success')->with('success', 'Order placed successfully.');
    }

    public function success(Request $request)
    {
        $user = $request->user(); // Get the authenticated user
        $customer = $user->customer; // Assuming the user has a `customer` relationship

        if (!$customer) {
            return redirect()->route('profile')->with('error', 'Customer profile not found. Please complete your profile.');
        }

        return view('checkout.success', compact('customer'));
    }

    public function failure(Request $request)
    {
        return view('checkout.failure', ['message' => $request->session()->get('error', 'Checkout was unsuccessful.')]);
    }
}
