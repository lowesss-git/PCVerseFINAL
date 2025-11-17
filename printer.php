<?php 
    // Start session to access cart data
    if (session_status() == PHP_SESSION_NONE) { 
        session_start(); 
    }
    // Include the file containing the getCartCount() function
    include 'includes/cart_functions.php'; 
    $cart_count = getCartCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Printers - PCVerse</title>
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
    <h1>Explore Our Printer Collection</h1>
    <p>Reliable, high-quality printing solutions for home, school, or office use between ₱10,000 – ₱20,000.</p>
  </div>

  <!-- Back Button -->
  <div class="back-btn-container">
    <button class="back-btn" onclick="window.location.href='product.php'">← Back to Products</button>
  </div>

  <!-- Product Grid -->
  <div class="content-container">

    <!-- Product 1 -->
    <div class="product-card">
      <img src="Images/Canon PIXMA G5700.jpeg" alt="All-in-One Printer">
      <h3>Canon PIXMA G5700</h3>
      <p>Megatank all-in-one printer with wireless connectivity, automatic duplex printing, and high-yield ink bottles.</p>
      <h4>₱12,500</h4>
      <button onclick="addToCart(801, 'Canon PIXMA G5700', 12500, 'Images/Canon PIXMA G5700.jpeg')">Buy Now</button>
    </div>

    <!-- Product 2 -->
    <div class="product-card">
      <img src="Images/Epson L6290.jpeg" alt="All-in-One Printer">
      <h3>Epson L6290</h3>
      <p>EcoTank all-in-one wireless printer with 30-page ADF, duplex printing, and Wi-Fi Direct connectivity.</p>
      <h4>₱18,000</h4>
      <button onclick="addToCart(802, 'Epson L6290', 18000, 'Images/Epson L6290.jpeg')">Buy Now</button>
    </div>

    <!-- Product 3 -->
    <div class="product-card">
      <img src="Images/Brother DCP-T425W.jpeg" alt="Laser Printer">
      <h3>Brother DCP-T425W</h3>
      <p>Inkjet all-in-one printer with mega tank system, wireless printing, and mobile device compatibility.</p>
      <h4>₱11,000</h4>
      <button onclick="addToCart(803, 'Brother DCP-T425W', 11000, 'Images/Brother DCP-T425W.jpeg')">Buy Now</button>
    </div>

    <!-- Product 4 -->
    <div class="product-card">
      <img src="Images/HP LaserJet Pro MFP M148fdw.jpeg" alt="Laser Printer">
      <h3>HP LaserJet Pro MFP M148fdw</h3>
      <p>Monochrome laser all-in-one with automatic duplex, 35-page ADF, wireless, and fast printing speeds.</p>
      <h4>₱19,000</h4>
      <button onclick="addToCart(804, 'HP LaserJet Pro MFP M148fdw', 19000, 'Images/HP LaserJet Pro MFP M148fdw.jpeg')">Buy Now</button>
    </div>

    <!-- Product 5 -->
    <div class="product-card">
      <img src="Images/Epson L3210.jpeg" alt="All-in-One Printer">
      <h3>Epson L3210</h3>
      <p>EcoTank single-function printer with ultra-low cost printing, Wi-Fi connectivity, and easy refill system.</p>
      <h4>₱10,000</h4>
      <button onclick="addToCart(805, 'Epson L3210', 10000, 'Images/Epson L3210.jpeg')">Buy Now</button>
    </div>

    <!-- Product 6 -->
    <div class="product-card">
      <img src="Images/Canon PIXMA G3770.jpeg" alt="All-in-One Printer">
      <h3>Canon PIXMA G3770</h3>
      <p>Megatank all-in-one with wireless connectivity, auto duplex, and support for various paper types.</p>
      <h4>₱16,200</h4>
      <button onclick="addToCart(806, 'Canon PIXMA G3770', 16200, 'Images/Canon PIXMA G3770.jpeg')">Buy Now</button>
    </div>

    <!-- Product 7 -->
    <div class="product-card">
      <img src="Images/Epson L6190.jpeg" alt="Photo Printer">
      <h3>Epson L6190</h3>
      <p>EcoTank all-in-one with 30-page ADF, duplex printing, Wi-Fi Direct, and professional photo quality.</p>
      <h4>₱14,500</h4>
      <button onclick="addToCart(807, 'Epson L6190', 14500, 'Images/Epson L6190.jpeg')">Buy Now</button>
    </div>

    <!-- Product 8 -->
    <div class="product-card">
      <img src="Images/HP Smart Tank 6001.jpeg" alt="All-in-One Printer">
      <h3>HP Smart Tank 6001</h3>
      <p>Wireless all-in-one printer with high-yield ink bottles, mobile printing, and automatic document feeder.</p>
      <h4>₱14,800</h4>
      <button onclick="addToCart(808, 'HP Smart Tank 6001', 14800, 'Images/HP Smart Tank 6001.jpeg')">Buy Now</button>
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