<?php
session_start();
include 'config/database.php';
include 'includes/cart_functions.php';
 $cart_count = getCartCount();

// Handle remove item action
if (isset($_GET['remove_id'])) {
    removeFromCart($_GET['remove_id']);
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart - PCVerse</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .cart-container {
      width: 80%;
      margin: 30px auto;
      background: #faeccf;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .cart-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px;
      border-bottom: 1px solid #ddd;
      background: white;
      margin-bottom: 10px;
      border-radius: 8px;
    }
    
    .cart-item img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
    }
    
    .item-details {
      flex-grow: 1;
      margin-left: 15px;
    }
    
    .item-price {
      font-weight: bold;
      color: #693F26;
      font-size: 1.1rem;
    }
    
    .quantity-controls {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .quantity-btn {
      background: #693F26;
      color: white;
      border: none;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      cursor: pointer;
    }
    
    .remove-btn {
      background: #dc3545;
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 20px;
      cursor: pointer;
      margin-left: 15px;
    }
    
    .cart-summary {
      margin-top: 30px;
      padding: 20px;
      background: white;
      border-radius: 8px;
      text-align: right;
    }
    
    .checkout-btn {
      background: #28a745;
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      cursor: pointer;
      font-size: 1.1rem;
      margin-top: 15px;
    }
    
    .empty-cart {
      text-align: center;
      padding: 40px;
      color: #666;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="">
    <div style="text-align: left;">
        <div class="container">
            <h1>PCVerse</h1>
            <div class="header-right">
                <div class="search-bar">
    <form action="search.php" method="GET" style="display: flex;">
        <input type="text" name="q" placeholder="Search..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
                <?php if (isset($_SESSION['user_id'])): ?>
<div class="hamburger-menu">
    <div class="hamburger-icon">
        <i class="fa fa-bars"></i>
    </div>
    <div class="dropdown-content">
        <a href="profile.php"><i class="fa fa-user"></i> View Profile</a>
        <a href="update_account.php"><i class="fa fa-user-edit"></i> Update Account</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>
</div>
<?php endif; ?>
            </div>
        </div>
    </div>
</header>

  <!-- Navigation -->
  <nav>
        <ul class="menu">
            <li><a href="Home.php">Home</a></li>
            <li><a href="product.php">Products</a></li>
            <li><a href="reviews.php">Reviews</a></li>    
            <li><a href="about.php">About us</a></li>
            <li><a href="contact.php">Contact</a></li>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <li>
                    <a href="#" class="welcome-link">
                        <i class="fa fa-user-circle"></i> 
                        Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                    </a>
                </li>
            <?php else: ?>
                <li><a href="login.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php' ? 'class="active"' : ''); ?>>Login</a></li>
                <li><a href="register.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'register.php' ? 'class="active"' : ''); ?>>Register</a></li>
            <?php endif; ?>

            <li>
                <a href="cart.php">
                    <i class="fa fa-shopping-cart"></i> 
                    Cart (<?php echo $cart_count; ?>)
                </a>
            </li>
        </ul>
    </nav>

  <!-- Welcome Banner -->
  <div class="welcome">
    <h1>Your Shopping Cart</h1>
    <p>Review your items and proceed to checkout</p>
  </div>

  <!-- Back Button -->
  <div class="back-btn-container">
    <button class="back-btn" onclick="window.location.href='product.php'">← Continue Shopping</button>
  </div>

  <!-- Cart Content -->
  <div class="cart-container">
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
      <?php foreach ($_SESSION['cart'] as $productId => $item): ?>
        <div class="cart-item">
          <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
          <div class="item-details">
            <h4><?php echo htmlspecialchars($item['name']); ?></h4>
            <div class="item-price">₱<?php echo number_format($item['price'], 2); ?></div>
          </div>
          <div class="quantity-controls">
            <span>Quantity: <?php echo $item['quantity']; ?></span>
          </div>
          <a href="cart.php?remove_id=<?php echo $productId; ?>" class="remove-btn" onclick="return confirm('Remove this item from cart?')">
            <i class="fa fa-trash"></i> Remove
          </a>
        </div>
      <?php endforeach; ?>
      
      <div class="cart-summary">
        <h3>Total: ₱<?php echo number_format(getCartTotal(), 2); ?></h3>
        <button class="checkout-btn" onclick="window.location.href='checkout.php'">Proceed to Checkout</button>
      </div>
    <?php else: ?>
      <div class="empty-cart">
        <i class="fa fa-shopping-cart" style="font-size: 3rem; color: #ccc; margin-bottom: 15px;"></i>
        <h3>Your cart is empty</h3>
        <p>Add some products to get started!</p>
      </div>
    <?php endif; ?>
  </div>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <div class="footer-about">
        <h3>PCVerse</h3>
        <p>Your trusted gateway to technology. Explore the best laptops, accessories, and PC builds tailored to your needs.</p>
      </div>

      <div class="footer-contact">
        <h4>Contact Us</h4>
        <p><i class="fa fa-map-marker"></i> Janssen Heights, Dampas District, Tagbilaran City</p>
        <p><i class="fa fa-phone"></i> +63 912 345 6789</p>
        <p><i class="fa fa-envelope"></i> PCverse@gmail.com</p>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2025 PCVerse. All rights reserved.</p>
    </div>
  </footer>

  <script src="js/script.js"></script>
</body>
</html>