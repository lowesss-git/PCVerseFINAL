<?php
session_start();
include 'config/database.php';

if (!isset($_GET['order'])) {
    header("Location: Home.php");
    exit();
}

$order_number = $_GET['order'];
$order_details = null;

try {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM orders WHERE order_number = :order_number LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':order_number', $order_number);
    $stmt->execute();
    
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $order_details = $row;
    } else {
        $error = "Order not found.";
    }

} catch (PDOException $exception) {
    $error = "Database error: " . $exception->getMessage();
}

$display_total = $order_details ? number_format($order_details['total_amount'], 2) : '0.00';
$payment_method = $order_details ? htmlspecialchars($order_details['payment_method']) : 'N/A';
$customer_name = $order_details ? htmlspecialchars($order_details['customer_name']) : 'Customer';

if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

include 'includes/cart_functions.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmation - PCVerse</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .confirmation-container {
      width: 60%;
      margin: 30px auto;
      background: #faeccf;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
      text-align: center;
    }
    
    .success-icon {
      font-size: 4rem;
      color: #28a745;
      margin-bottom: 20px;
    }
    
    .order-details {
      background: white;
      border-radius: 8px;
      padding: 25px;
      margin: 25px 0;
      text-align: left;
    }
    
    .detail-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      padding-bottom: 5px;
      border-bottom: 1px solid #eee;
    }
    
    .detail-row:last-child {
      border-bottom: none;
      font-weight: bold;
    }
    
    .total-amount {
      font-size: 1.5rem;
      color: #693F26;
      margin-top: 20px;
      border-top: 2px solid #693F26;
      padding-top: 15px;
    }
    
    .btn-back {
      background: #693F26;
      color: white;
      text-decoration: none;
      padding: 12px 25px;
      border-radius: 25px;
      display: inline-block;
      margin-top: 20px;
      transition: background 0.3s;
    }
    
    .btn-back:hover {
      background: #3B2415;
    }
  </style>
</head>
<body>

  <header class="">
    <div style="text-align: left;">
        <div class="container">
            <h1>PCVerse</h1>
            <div class="header-right">
                <<div class="search-bar">
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

  <div class="welcome">
    <h1>Order Confirmation</h1>
    <p>Thank you for your purchase, <?php echo $customer_name; ?>!</p>
  </div>

  <div class="confirmation-container">
    <?php if ($order_details): ?>
        <i class="fa fa-check-circle success-icon"></i>
        <h2>Your Order Has Been Placed Successfully!</h2>
        <p>A confirmation email will be sent to your inbox shortly.</p>

        <div class="order-details">
            <div class="detail-row">
                <span>Order Number:</span>
                <strong id="order-number"><?php echo htmlspecialchars($order_number); ?></strong>
            </div>
            <div class="detail-row">
                <span>Order Date:</span>
                <span id="order-date"><?php echo date('F j, Y'); ?></span>
            </div>
            <div class="detail-row">
                <span>Payment Method:</span>
                <span id="payment-method"><?php echo ucfirst($payment_method); ?></span>
            </div>
            <div class="detail-row">
                <span>Estimated Delivery:</span>
                <span id="delivery-date"><?php 
                    $deliveryDate = new DateTime();
                    $deliveryDate->modify('+3 days');
                    echo $deliveryDate->format('F j, Y'); 
                ?></span>
            </div>
            <div class="total-amount">
                <span>Total Amount Paid:</span>
                <strong id="order-amount">₱<?php echo $display_total; ?></strong>
            </div>
        </div>
        
        <a href="Home.php" class="btn-back">Continue Shopping</a>
        
    <?php else: ?>
        <i class="fa fa-times-circle" style="font-size: 4rem; color: #dc3545; margin-bottom: 20px;"></i>
        <h2>Order Error</h2>
        <p><?php echo isset($error) ? $error : "We could not find your order details."; ?></p>
        <a href="Home.php" class="btn-back">Go to Homepage</a>
    <?php endif; ?>
  </div>

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
    function getDeliveryDate() {
      const deliveryDate = new Date();
      deliveryDate.setDate(deliveryDate.getDate() + 3);
      return deliveryDate.toLocaleDateString();
    }
  </script>
</body>
</html>