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
  <title>Monitors - PCVerse</title>
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
    <h1>Explore Our Monitor Collection</h1>
    <p>Discover vibrant, ultra-smooth displays with high refresh rates and stunning visuals between ₱10,000 – ₱20,000.</p>
  </div>

  <!-- Back Button -->
  <div class="back-btn-container">
    <button class="back-btn" onclick="window.location.href='product.php'">← Back to Products</button>
  </div>

  <!-- Product Grid -->
  <div class="content-container">

    <!-- Product 1 -->
    <div class="product-card">
      <img src="Images/ASUS TUF Gaming VG249Q.jpg" alt="Gaming Monitor">
      <h3>ASUS TUF Gaming VG249Q</h3>
      <p>23.8" IPS Full HD, 144Hz refresh rate, 1ms response time, and Adaptive-Sync for smooth gaming.</p>
      <h4>₱12,000</h4>
      <button onclick="addToCart(501, 'ASUS TUF Gaming VG249Q', 12000, 'Images/ASUS TUF Gaming VG249Q.jpg')">Buy Now</button>
    </div>

    <!-- Product 2 -->
    <div class="product-card">
      <img src="Images/MSI Optix G241.jpg" alt="Gaming Monitor">
      <h3>MSI Optix G241</h3>
      <p>24" IPS display, 144Hz refresh rate, 1ms response, and RGB lighting with thin bezel design.</p>
      <h4>₱11,500</h4>
      <button onclick="addToCart(502, 'MSI Optix G241', 11500, 'Images/MSI Optix G241.jpg')">Buy Now</button>
    </div>

    <!-- Product 3 -->
    <div class="product-card">
      <img src="Images/Acer Nitro XV240Y.jpg" alt="Gaming Monitor">
      <h3>Acer Nitro XV240Y</h3>
      <p>23.8" Full HD IPS, 165Hz refresh rate, 0.5ms response, AMD FreeSync Premium, and HDR support.</p>
      <h4>₱13,000</h4>
      <button onclick="addToCart(503, 'Acer Nitro XV240Y', 13000, 'Images/Acer Nitro XV240Y.jpg')">Buy Now</button>
    </div>

    <!-- Product 4 -->
    <div class="product-card">
      <img src="Images/Samsung Odyssey G3.jpg" alt="Curved Monitor">
      <h3>Samsung Odyssey G3</h3>
      <p>24" curved VA panel, 144Hz refresh rate, 1ms response, and AMD FreeSync for immersive gaming.</p>
      <h4>₱12,500</h4>
      <button onclick="addToCart(504, 'Samsung Odyssey G3', 12500, 'Images/Samsung Odyssey G3.jpg')">Buy Now</button>
    </div>

    <!-- Product 5 -->
    <div class="product-card">
      <img src="Images/ViewSonic XG2405.jpg" alt="Gaming Monitor">
      <h3>ViewSonic XG2405</h3>
      <p>24" IPS Full HD, 144Hz, 1ms response, AMD FreeSync, and ultra-thin bezels for multi-monitor setup.</p>
      <h4>₱13,500</h4>
      <button onclick="addToCart(505, 'ViewSonic XG2405', 13500, 'Images/ViewSonic XG2405.jpg')">Buy Now</button>
    </div>

    <!-- Product 6 -->
    <div class="product-card">
      <img src="Images/LG 24GN650-B.jpg" alt="Professional Monitor">
      <h3>LG 24GN650-B</h3>
      <p>24" IPS display, 144Hz refresh rate, 1ms response, HDR10, and sRGB 99% color gamut for accurate colors.</p>
      <h4>₱14,000</h4>
      <button onclick="addToCart(506, 'LG 24GN650-B', 14000, 'Images/LG 24GN650-B.jpg')">Buy Now</button>
    </div>

    <!-- Product 7 -->
    <div class="product-card">
      <img src="Images/ASUS VP249QGR.jpg" alt="Ultra Gaming Monitor">
      <h3>ASUS VP249QGR</h3>
      <p>23.8" IPS, 144Hz, 1ms MPRT, Adaptive-Sync, and shadow boost for better visibility in dark scenes.</p>
      <h4>₱11,000</h4>
      <button onclick="addToCart(507, 'ASUS VP249QGR', 11000, 'Images/ASUS VP249QGR.jpg')">Buy Now</button>
    </div>

    <!-- Product 8 -->
    <div class="product-card">
      <img src="Images/AOC 24G2E.jpg" alt="Premium Monitor">
      <h3>AOC 24G2E</h3>
      <p>23.8" IPS frameless design, 144Hz, 1ms response, AMD FreeSync, and height adjustable stand.</p>
      <h4>₱15,800</h4>
      <button onclick="addToCart(508, 'AOC 24G2E', 15800, 'Images/AOC 24G2E.jpg')">Buy Now</button>
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