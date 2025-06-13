<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderProduct;
use App\Models\PaymentVNPAY;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\True_;
use Session;

class PaymentController extends Controller
{
    public function store(Request $request)
    {

        $total_cart = (int)Cart::subtotal(null, null, '');
        $total_coupon = 0;
        $price_total = $total_cart - $total_coupon;

        if (session()->has('coupon')) {
            foreach (session()->get('coupon') as $key => $cou) {
                if ($cou['coupon_condition'] == 1) {
                    $total_coupon = ($total_cart * ((int)$cou['coupon_number'])) / 100;
                } else {
                    $total_coupon = $cou['coupon_number'];
                }
            }
        }

        $items = Cart::content();
        $vnp_TxnRef = 'VNPTF' . Carbon::now()->timestamp;
        $vnp_OrderInfo = 'Thanh toan don hang vnpay';
        $vnp_OrderType = 'other';
        $vnp_Amount = $price_total * 100;
        $vnp_Locale = 'vn';
        if ($request->input('bank_code')) {
            $vnp_BankCode = $request->input('bank_code');
        }
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => env('VNP_TMN_CODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => env('VNP_RETURN_URL'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if ($request->has('payment_type')) {
            if ((int)$request->input('payment_type') == Order::TRANSFER) {
                $this->storePayment($inputData, Order::TRANSFER, $items, $price_total, $request->input('note'));
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }
                $vnp_Url = env('VNP_URL') . "?" . $query;
                if (env('VNP_HASHSECRET')) {
                    $vnpSecureHash =   hash_hmac('sha512', $hashdata, env('VNP_HASHSECRET'));
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }

                //                dd($vnp_Url);
                //
                //                https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?vnp_Amount=55000000&vnp_Command=pay&vnp_CreateDate=20221012153028&vnp_CurrCode=VND&vnp_IpAddr=127.0.0.1&vnp_Locale=vi&vnp_OrderInfo=Thanh+to%C3%A1n+%C4%91%C6%A1n+h%C3%A0ng+qua+v%C3%AD+VNPAY&vnp_OrderType=other&vnp_ReturnUrl=http%3A%2F%2F127.0.0.1%3A8000%2Freturn&vnp_TmnCode=PE0X413P&vnp_TxnRef=VNPTF1665588628&vnp_Version=2.1.0&vnp_SecureHash=8a4a50629684c108c89c39c138814bb90b2eb1334b8090c73716b1db4409fbf5fe1007e1cbcee70b343e0f4e574b078d749191c32549daaaa00578da1952d4d6
                //                https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?vnp_Amount=1806000&vnp_Command=pay&vnp_CreateDate=20210801153333&vnp_CurrCode=VND&vnp_IpAddr=127.0.0.1&vnp_Locale=vn&vnp_OrderInfo=Thanh+toan+don+hang+%3A5&vnp_OrderType=other&vnp_ReturnUrl=https%3A%2F%2Fdomainmerchant.vn%2FReturnUrl&vnp_TmnCode=DEMOV210&vnp_TxnRef=5&vnp_Version=2.1.0&vnp_SecureHash=3e0d61a0c0534b2e36680b3f7277743e8784cc4e1d68fa7d276e79c23be7d6318d338b477910a27992f5057bb1582bd44bd82ae8009ffaf6d141219218625c42

                return redirect($vnp_Url);
            } else {
                $this->storePayment(null, Order::CASH, $items, $price_total, $request->input('note'));
                $request->session()->flash('success', 'Đặt hàng thành công');
                return redirect()->intended('/account');
            }
        }
    }

    public function storePayment($data = null, $type, $items, $price_total, $note)
    {
        $order = new Order();
        $order->customer_id = Auth::guard('web')->id();
        $order->total = $price_total;
        $order->payment_type = $type;
        $order->note = $note;
        $order->status = Order::WAIT;
        $order->save();

        foreach ($items as $item) {
            $product =  Product::where('id', $item->id)->with(['category'])->first();
            $orderDetail = new OrderProduct();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_name = $product->name;
            $orderDetail->product_category = $product->category->name ?? '';
            $orderDetail->product_quantity = 1;
            $orderDetail->product_sale_price = $product->sale_price;
            $orderDetail->product_origin_price = $product->origin_price;
            $orderDetail->total = $product->sale_price;
            $orderDetail->product_id = $product->id;
            $orderDetail->save();
            if (!empty($data)) {
                $this->storePaymentVnpay($data, $order->id);
            }
        }
        session()->forget('coupon');
        Cart::destroy();
    }

    public function storePaymentVnpay($data, $orderId)
    {
        $payment = new PaymentVNPAY();
        $payment->customer_id = Auth::guard('web')->id();
        $payment->order_id = $orderId;
        $payment->code = $data['vnp_TxnRef'];
        $payment->money = $data['vnp_Amount'] / 100;
        $payment->content = $data['vnp_OrderInfo'];
        $payment->status = PaymentVNPAY::STATUS['UNPAID'];
        if (!empty($data['vnp_BankCode'])) {
            $payment->code_bank = $data['vnp_BankCode'];
        }
        $payment->time = null;
        $payment->save();
    }

    public function paymentSuccess($request)
    {
        $inputData = array();
        $returnData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, env('VNP_HASHSECRET'));
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        if ($inputData['vnp_BankCode']) {
            $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        }
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi

        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                $payment = PaymentVNPAY::where('code', $orderId)->first();
                if (isset($payment)) {
                    if ($payment->money == $vnp_Amount) {
                        if (isset($payment->status) && $payment->status == PaymentVNPAY::STATUS['UNPAID']) {
                            if ($inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
                                $Status = 1; // Trạng thái thanh toán thành công
                                $payment->status = PaymentVNPAY::STATUS['SUCCESS'];
                                $payment->time = $inputData['vnp_PayDate'];
                                if ($vnp_BankCode) {
                                    $payment->code_bank = $vnp_BankCode;
                                }
                                $payment->save();

                                $order = Order::find($payment->order_id);
                                $order->status = Order::WAIT;
                                $order->save();
                            } else {
                                $Status = 2; // Trạng thái thanh toán thất bại / lỗi
                            }
                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (\Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
    }

    public function return(Request $request)
    {
        $this->paymentSuccess($request);
        $request->session()->flash('success', 'Thanh toán thành công');
        return redirect()->intended('/');
    }
}
