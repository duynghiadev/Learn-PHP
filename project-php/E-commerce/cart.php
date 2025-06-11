<?php
session_start();

// Bật thông báo lỗi để debug (có thể tắt khi đưa lên production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'includes/config.php'; // luôn cần kết nối DB

// Xử lý xóa item trong giỏ hàng
if (isset($_POST['delete']) && isset($_GET['pid']) && isset($_GET['q'])) {
  $pid = (int) $_GET['pid'];
  $q = (int) $_GET['q'];

  $sql = "DELETE FROM carts WHERE pid=$pid AND quantity=$q AND uid={$_SESSION['id']} AND status='active' LIMIT 1";
  $conn->query($sql);

  header("Location:cart.php?itemRemovedSuccessfully");
  exit;
}

include_once('./includes/headerNav.php');

// Kiểm tra người dùng đăng nhập
if (!isset($_SESSION['id'])) {
  header("location:index.php?UnathorizedUser");
  exit;
}

include_once('./stripeConfig.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-commerce Cart</title>
</head>

<body>
  <div class='cart'>
    <div class="container">
      <h1 style='float:left'>Cart</h1>
      <div style='width:100%;height:100%;overflow:hidden' class='tableBtm'>

        <?php
        $total = 0;
        $pidArray = [];
        $quantArray = [];

        $sql = "SELECT * FROM carts WHERE uid={$_SESSION['id']} AND status='active'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
        ?>
          <table>
            <thead>
              <tr>
                <th>Sn</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sn = 0;
              while ($row = $result->fetch_assoc()) {
                $sn++;
                $pidArray[] = $row['pid'];
                $quantArray[] = $row['quantity'];

                $encodedPidData = urlencode(serialize($pidArray));
                $encodedQuantityData = urlencode(serialize($quantArray));
                $subtotal = $row["price"] * $row["quantity"];
                $total += $subtotal;
              ?>
                <tr>
                  <td><?= $sn ?></td>
                  <td><?= htmlspecialchars($row["product"]) ?></td>
                  <td><?= $row["price"] ?></td>
                  <td><?= $row["quantity"] ?></td>
                  <td><?= $subtotal ?></td>
                  <td>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>?pid=<?= $row['pid'] ?>&q=<?= $row['quantity'] ?>" method="post">
                      <button name='delete' type='submit' class="btn btn-danger">Remove</button>
                    </form>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <div class="text-end">
            <h5>Total: <?= $total ?> </h5>
          </div>

          <div class="text-end">
            <form action="./paymentVerify.php?id=<?= $encodedPidData ?>&q=<?= $encodedQuantityData ?>" method="post">
              <button class="btn" style="background:#11C9B6;">
                <a href="./index.php" style='color:white;text-decoration:none;'>Continue Shopping</a>
              </button>

              <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="<?= $publishableKey ?>"
                data-amount="<?= $total + 50 ?>"
                data-name="Electric-Shop"
                data-description="Your Choice Our Voice"
                data-image="./logo1.png"
                data-currency="usd"
                data-email="<?= htmlspecialchars($_SESSION['customer_email']) ?>">
              </script>
            </form>
          </div>
        <?php
        } else {
          echo '<div style="text-align: center; padding: 40px;">';
          echo '<h3>Your cart is empty</h3>';
          echo '<a href="index.php" class="btn" style="background: #11C9B6;">Start Shopping</a>';
        }
        ?>
      </div>
    </div>
  </div>
  <br><br>
</body>

<?php include_once('./includes/footer.php'); ?>

</html>