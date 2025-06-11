<?php
include "includes/config.php";
include_once('./includes/headerNav.php');

// Validate product ID
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
  header("Location: index.php?error=invalid_product");
  exit();
}

$product_id = (int)$_GET['id'];

// Get product details with prepared statement
$sql = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  header("Location: index.php?error=product_not_found");
  exit();
}

$product = $result->fetch_assoc();
$stmt->close();

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addToCart'])) {
  if (!isset($_SESSION['id'])) {
    $_SESSION['redirect_url'] = "product.php?id=" . $product_id;
    header("Location: login.php?error=login_required");
    exit();
  }

  $quantity = isset($_POST['quantity']) ? max(1, min(5, (int)$_POST['quantity'])) : 1;

  // Check if product already in cart
  $check_sql = "SELECT * FROM carts WHERE pid = ? AND uid = ?";
  $check_stmt = $conn->prepare($check_sql);
  $check_stmt->bind_param("ii", $product_id, $_SESSION['id']);
  $check_stmt->execute();
  $check_result = $check_stmt->get_result();

  if ($check_result->num_rows > 0) {
    // Update quantity if exists
    $update_sql = "UPDATE carts SET quantity = quantity + ? WHERE pid = ? AND uid = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("iii", $quantity, $product_id, $_SESSION['id']);
    $update_stmt->execute();
    $update_stmt->close();
  } else {
    // Insert new cart item
    $insert_sql = "INSERT INTO carts (pid, uid, product, price, quantity) VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param(
      "iisdi",
      $product_id,
      $_SESSION['id'],
      $product['product_title'],
      $product['product_price'],
      $quantity
    );
    $insert_stmt->execute();
    $insert_stmt->close();
  }

  $check_stmt->close();
  $_SESSION['cart_success'] = "Product added to cart successfully!";
  header("Location: product.php?id=" . $product_id);
  exit();
}

// Simplified image handling - use the path directly from database
$display_image_path = 'admin/upload/' . $product['product_img'];

// Kiểm tra file tồn tại với đường dẫn tương đối
if (empty($product['product_img'])) {
  $display_image_path = 'admin/upload/default-product.jpg';
} elseif (!file_exists($display_image_path)) {
  // Nếu file không tồn tại, thử kiểm tra với đường dẫn tuyệt đối
  $absolute_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $display_image_path;
  if (!file_exists($absolute_path)) {
    $display_image_path = 'https://via.placeholder.com/400?text=Product+Image';
  }
}

// Calculate discount if available
$original_price = isset($product['original_price']) ? $product['original_price'] : $product['product_price'] * 1.1;
$discount_percent = round(100 - ($product['product_price'] / $original_price * 100));
$has_discount = $discount_percent > 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($product['product_title']); ?> | E-commerce Store</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="./css/product.css">
</head>

<body>
  <?php if (isset($_SESSION['cart_success'])): ?>
    <div class="notification" id="cart-notification">
      <i class="fas fa-check-circle"></i> <?php echo $_SESSION['cart_success']; ?>
    </div>
    <?php unset($_SESSION['cart_success']); ?>
  <?php endif; ?>

  <div class="product-container">
    <div class="product-gallery">
      <img src="<?php echo $display_image_path; ?>" alt="<?php echo htmlspecialchars($product['product_title']); ?>" class="main-image" id="main-image">

      <div class="thumbnail-container">
        <img src="<?php echo htmlspecialchars($display_image_path); ?>" class="thumbnail active" data-image="<?php echo htmlspecialchars($display_image_path); ?>">
        <!-- Additional thumbnails can be added here if product has multiple images -->
      </div>
    </div>

    <div class="product-details">
      <h1 class="product-title"><?php echo htmlspecialchars($product['product_title']); ?></h1>

      <div class="product-meta">
        <span><i class="fas fa-box"></i> SKU: <?php echo htmlspecialchars($product['product_id']); ?></span>
        <span><i class="fas fa-calendar-alt"></i> Added: <?php echo date('M d, Y', strtotime($product['product_date'])); ?></span>
        <span><i class="fas fa-tag"></i> Category: <?php echo htmlspecialchars($product['product_catag']); ?></span>
      </div>

      <div class="rating">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star-half-alt"></i>
        <span>(24 reviews)</span>
      </div>

      <div class="price-container">
        <span class="current-price">VND <?php echo number_format($product['product_price'], 0, ',', '.'); ?></span>
        <?php if ($has_discount): ?>
          <span class="original-price">VND <?php echo number_format($original_price, 0, ',', '.'); ?></span>
          <span class="discount-badge">Save <?php echo $discount_percent; ?>%</span>
        <?php endif; ?>
      </div>

      <div class="stock-status <?php
                                echo $product['product_left'] > 10 ? 'in-stock' : ($product['product_left'] > 0 ? 'low-stock' : 'out-of-stock'); ?>">
        <i class="fas fa-<?php echo $product['product_left'] > 0 ? 'check' : 'times'; ?>-circle"></i>
        <?php
        if ($product['product_left'] > 10) {
          echo "In Stock (" . $product['product_left'] . " available)";
        } elseif ($product['product_left'] > 0) {
          echo "Low Stock (Only " . $product['product_left'] . " left)";
        } else {
          echo "Out of Stock";
        }
        ?>
      </div>

      <form method="post" action="">
        <div class="quantity-selector">
          <label for="quantity">Quantity:</label>
          <button type="button" class="quantity-btn" onclick="decreaseQuantity()">-</button>
          <input type="number" id="quantity" name="quantity" class="quantity-input" value="1" min="1" max="<?php echo $product['product_left'] > 0 ? $product['product_left'] : 1; ?>">
          <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
        </div>

        <div class="action-buttons">
          <?php if ($product['product_left'] > 0): ?>
            <button type="submit" name="addToCart" class="btn btn-secondary">
              <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
            <a href="checkout.php?product_id=<?php echo $product_id; ?>&quantity=1" class="btn btn-primary">
              <i class="fas fa-bolt"></i> Buy Now
            </a>
          <?php else: ?>
            <button class="btn btn-secondary" disabled>
              <i class="fas fa-bell"></i> Notify When Available
            </button>
          <?php endif; ?>

          <button type="button" class="btn btn-outline">
            <i class="far fa-heart"></i> Add to Wishlist
          </button>
        </div>
      </form>

      <div class="product-description">
        <h3>Description</h3>
        <p><?php echo nl2br(htmlspecialchars($product['product_desc'])); ?></p>
      </div>

      <div class="specifications">
        <h3>Specifications</h3>
        <table class="specs-table">
          <tr>
            <td>Author</td>
            <td><?php echo htmlspecialchars($product['product_author']); ?></td>
          </tr>
          <tr>
            <td>Category</td>
            <td><?php echo htmlspecialchars($product['product_catag']); ?></td>
          </tr>
          <tr>
            <td>Release Date</td>
            <td><?php echo date('F j, Y', strtotime($product['product_date'])); ?></td>
          </tr>
          <!-- Add more specifications as needed -->
        </table>
      </div>
    </div>
  </div>

  <div class="zoom-overlay" id="zoom-overlay">
    <img src="" class="zoomed-image" id="zoomed-image">
  </div>

  <script>
    // Quantity controls
    function increaseQuantity() {
      const input = document.getElementById('quantity');
      const max = parseInt(input.max);
      let value = parseInt(input.value);
      if (value < max) {
        input.value = value + 1;
      }
    }

    function decreaseQuantity() {
      const input = document.getElementById('quantity');
      let value = parseInt(input.value);
      if (value > 1) {
        input.value = value - 1;
      }
    }

    // Image zoom functionality
    const mainImage = document.getElementById('main-image');
    const zoomOverlay = document.getElementById('zoom-overlay');
    const zoomedImage = document.getElementById('zoomed-image');

    mainImage.addEventListener('click', function() {
      zoomedImage.src = this.src;
      zoomOverlay.classList.add('active');
    });

    zoomOverlay.addEventListener('click', function() {
      this.classList.remove('active');
    });

    // Thumbnail click handler
    document.querySelectorAll('.thumbnail').forEach(thumb => {
      thumb.addEventListener('click', function() {
        document.querySelector('.thumbnail.active').classList.remove('active');
        this.classList.add('active');
        mainImage.src = this.dataset.image;
      });
    });

    // Show notification if exists
    const notification = document.getElementById('cart-notification');
    if (notification) {
      setTimeout(() => {
        notification.classList.add('show');

        setTimeout(() => {
          notification.classList.remove('show');
        }, 3000);
      }, 100);
    }
  </script>

  <?php include_once('./includes/footer.php'); ?>
</body>

</html>