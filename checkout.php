<?php
session_start();

// 1. VALIDATION: Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Set a session variable to remember the intended page (checkout.php)
    $_SESSION['redirect_url'] = 'checkout.php'; 
    // Redirect to login page with a flag
    header("Location: login.php?checkout_required=true");
    exit();
}

include 'config/database.php';
include 'includes/cart_functions.php';
$cart_count = getCartCount();

// Redirect if cart is empty (This existing logic now runs only if the user is logged in)
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: cart.php");
    exit();
}

// Process order if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    // Generate order number
    $order_number = 'PCV' . date('YmdHis');
    $total_amount = getCartTotal() + 150; // Add shipping
    
    // Save order to database
    $query = "INSERT INTO orders SET 
              order_number=:order_number, 
              customer_name=:customer_name,
              customer_email=:customer_email,
              customer_phone=:customer_phone,
              customer_address=:customer_address,
              city=:city,
              zip_code=:zip_code,
              total_amount=:total_amount,
              payment_method=:payment_method";
    
    $stmt = $db->prepare($query);
    
    $customer_name = $_POST['firstName'] . ' ' . $_POST['lastName'];
    
    $stmt->bindParam(":order_number", $order_number);
    $stmt->bindParam(":customer_name", $customer_name);
    $stmt->bindParam(":customer_email", $_POST['email']);
    $stmt->bindParam(":customer_phone", $_POST['phone']);
    $stmt->bindParam(":customer_address", $_POST['address']);
    $stmt->bindParam(":city", $_POST['city']);
    $stmt->bindParam(":zip_code", $_POST['zipCode']);
    $stmt->bindParam(":total_amount", $total_amount);
    $stmt->bindParam(":payment_method", $_POST['payment_method']);
    
    if ($stmt->execute()) {
        $order_id = $db->lastInsertId();
        
        // Save order items
        foreach ($_SESSION['cart'] as $productId => $item) {
            $query = "INSERT INTO order_items SET 
                      order_id=:order_id,
                      product_name=:product_name,
                      price=:price,
                      quantity=:quantity";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(":order_id", $order_id);
            $stmt->bindParam(":product_name", $item['name']);
            $stmt->bindParam(":price", $item['price']);
            $stmt->bindParam(":quantity", $item['quantity']);
            $stmt->execute();
        }
        
        // Clear cart and redirect
        unset($_SESSION['cart']);
        header("Location: orderconfirm.php?order=" . $order_number);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - PCVerse</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .checkout-container {
      width: 80%;
      margin: 30px auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
    }
    
    .checkout-form, .order-summary {
      background: #faeccf;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #693F26;
    }
    
    .form-group input, .form-group select, .form-group textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
    }
    
    .payment-methods {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
      margin-top: 10px;
    }
    
    .payment-method {
      border: 2px solid #ddd;
      padding: 15px;
      border-radius: 8px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .payment-method.selected {
      border-color: #693F26;
      background: #f0e6d3;
    }
    
    .order-item {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px solid #ddd;
    }
    
    .order-total {
      font-size: 1.2rem;
      font-weight: bold;
      color: #693F26;
      margin-top: 15px;
      padding-top: 15px;
      border-top: 2px solid #693F26;
    }
    
    .place-order-btn {
      background: #28a745;
      color: white;
      border: none;
      padding: 15px 30px;
      border-radius: 25px;
      cursor: pointer;
      font-size: 1.1rem;
      width: 100%;
      margin-top: 20px;
    }
    
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
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
    <h1>Checkout</h1>
    <p>Complete your purchase with secure payment</p>
  </div>

  <!-- Checkout Content -->
  <div class="checkout-container">
    <!-- Shipping & Payment Form -->
    <div class="checkout-form">
      <h3>Shipping Information</h3>
      <form id="checkout-form" method="POST">
        <div class="form-row">
          <div class="form-group">
            <label for="firstName">First Name *</label>
            <input type="text" id="firstName" name="firstName" required>
          </div>
          <div class="form-group">
            <label for="lastName">Last Name *</label>
            <input type="text" id="lastName" name="lastName" required>
          </div>
        </div>
        
        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
          <label for="phone">Phone Number *</label>
          <input type="tel" id="phone" name="phone" required>
        </div>
        
        <div class="form-group">
          <label for="address">Shipping Address *</label>
          <textarea id="address" name="address" rows="3" required></textarea>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="city">City *</label>
            <input type="text" id="city" name="city" required>
          </div>
          <div class="form-group">
            <label for="zipCode">ZIP Code *</label>
            <input type="text" id="zipCode" name="zipCode" required>
          </div>
        </div>
        
        <h3>Payment Method *</h3>
        <div class="payment-methods">
          <div class="payment-method" onclick="selectPayment('credit-card')">
            <i class="fa fa-credit-card" style="font-size: 2rem;"></i>
            <div>Credit Card</div>
          </div>
          <div class="payment-method" onclick="selectPayment('gcash')">
            <i class="fa fa-mobile" style="font-size: 2rem;"></i>
            <div>GCash</div>
          </div>
          <div class="payment-method" onclick="selectPayment('paypal')">
            <i class="fa fa-paypal" style="font-size: 2rem;"></i>
            <div>PayPal</div>
          </div>
          <div class="payment-method" onclick="selectPayment('cod')">
            <i class="fa fa-money-bill" style="font-size: 2rem;"></i>
            <div>Cash on Delivery</div>
          </div>
        </div>
        
        <input type="hidden" id="payment-method" name="payment_method" required>
        
        <button type="submit" class="place-order-btn">Place Order</button>
      </form>
    </div>
    
    <!-- Order Summary -->
    <div class="order-summary">
      <h3>Order Summary</h3>
      <div id="order-items">
        <?php if (isset($_SESSION['cart'])): ?>
          <?php foreach ($_SESSION['cart'] as $item): ?>
            <div class="order-item">
              <div>
                <strong><?php echo htmlspecialchars($item['name']); ?></strong>
                <div>Qty: <?php echo $item['quantity']; ?> × ₱<?php echo number_format($item['price'], 2); ?></div>
              </div>
              <div>₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></div>
            </div>
          <?php endforeach; ?>
          
          <div class="order-item">
            <div><strong>Shipping Fee</strong></div>
            <div>₱150.00</div>
          </div>
        <?php endif; ?>
      </div>
      <div class="order-total">
        Total: ₱<?php echo number_format(getCartTotal() + 150, 2); ?>
      </div>
    </div>
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

  <script>
    function selectPayment(method) {
      // Remove selected class from all payment methods
      document.querySelectorAll('.payment-method').forEach(pm => {
        pm.classList.remove('selected');
      });
      
      // Add selected class to clicked method
      event.currentTarget.classList.add('selected');
      
      // Set the hidden input value
      document.getElementById('payment-method').value = method;
    }

    // Set default payment method
    document.addEventListener('DOMContentLoaded', function() {
      selectPayment('credit-card');
    });
  </script>
</body>
</html>