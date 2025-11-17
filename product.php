<?php 
    // Start session to access cart data
    if (session_status() == PHP_SESSION_NONE) { 
        session_start(); 
    }
    // Include the file containing the getCartCount() function
     // Include the file containing the getCartCount() function
    include 'includes/cart_functions.php'; 
    $cart_count = getCartCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products - PCVerse</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
</div>
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

  <!-- Welcome -->
  <div class="welcome">
    <h1>Our Product Categories</h1>
    <p>Explore a full range of technology essentials — from gaming laptops to accessories.</p>
  </div>

  <!-- Product Categories -->
  <div class="content-container">
    <!-- Category 1 -->
    <div class="product-card">
      <img src="images/gaminglaptop.jpeg" alt="Laptop">
      <h3>Laptops</h3>
      <p>High-performance laptops built for gaming, work, and creativity.</p>
      <h4>₱50,000 - ₱100,000</h4>
      <button onclick="window.location.href='laptops.php'">View Laptops</button>
    </div>

    <!-- Category 2 -->
    <div class="product-card">
      <img src="images/gamingkeyboard.jpeg" alt="Keyboard">
      <h3>Keyboards</h3>
      <p>RGB mechanical keyboards designed for precision, comfort, and style.</p>
      <h4>₱1,000 - ₱5,000</h4>
      <button onclick="window.location.href='keyboards.php'">View Keyboards</button>

    </div>

    <!-- Category 3 -->
    <div class="product-card">
      <img src="images/asustuf.jpeg" alt="Mouse">
      <h3>Mice</h3>
      <p>Ergonomic, high-DPI gaming mice with programmable buttons.</p>
      <h4>₱500 - ₱2,000</h4>
      <button onclick="window.location.href='mice.php'">View Mice</button>
    </div>

    <!-- Category 4 -->
    <div class="product-card">
      <img src="images/headset.jpeg" alt="Headset">
      <h3>Headsets</h3>
      <p>Immersive surround sound with noise-cancelling microphones.</p>
      <h4>₱1,500 - ₱5,000</h4>
      <button onclick="window.location.href='headset.php'">View Headsets</button>
    </div>

    <!-- Category 5 -->
    <div class="product-card">
      <img src="images/Monitor.jpeg" alt="Monitor">
      <h3>Monitors</h3>
      <p>Vibrant, ultra-smooth displays for productivity and gaming.</p>
      <h4>₱10,000 - ₱20,000</h4>
      <button onclick="window.location.href='monitor.php'">View Monitors</button>
    </div>

    <!-- Category 6 -->
    <div class="product-card">
      <img src="images/pc.jpeg" alt="Custom PC">
      <h3>Custom PCs</h3>
      <p>Build your dream setup with the best components and cooling systems.</p>
      <h4>₱35,000 - ₱60,000</h4>
      <button onclick="window.location.href='pc.php'">View PCs</button>
    </div>

    <!-- Category 7 -->
    <div class="product-card">
      <img src="images/router.jpeg" alt="Router">
      <h3>Routers</h3>
      <p>Experience faster and more reliable WiFi for gaming and streaming.</p>
      <h4>₱11,500 - ₱15,000</h4>
      <button onclick="window.location.href='router.php'">View Routers</button>
    </div>

    <!-- Category 8 -->
    <div class="product-card">
      <img src="images/printer.jpeg" alt="Printer">
      <h3>Printers</h3>
      <p>Reliable, high-quality printing for home, school, or office use.</p>
      <h4>₱10,000 - ₱20,000</h4>
      <button onclick="window.location.href='printer.php'">View Printers</button>
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

  <script src="js/script.js"></script>
</body>
</html>
