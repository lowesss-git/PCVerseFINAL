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
  <title>Routers - PCVerse</title>
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
    <h1>Explore Our Router Collection</h1>
    <p>Experience faster and more reliable WiFi with our premium router selection between ₱11,500 – ₱15,000.</p>
  </div>

  <!-- Back Button -->
  <div class="back-btn-container">
    <button class="back-btn" onclick="window.location.href='product.php'">← Back to Products</button>
  </div>

  <!-- Product Grid -->
  <div class="content-container">

    <!-- Product 1 -->
    <div class="product-card">
      <img src="Images/TP-Link Archer AX73.jpeg" alt="WiFi Router">
      <h3>TP-Link Archer AX73</h3>
      <p>Dual-band WiFi 6, 5400Mbps, 8 streams, OFDMA technology, and extensive coverage for large homes.</p>
      <h4>₱12,500</h4>
      <button onclick="addToCart(701, 'TP-Link Archer AX73', 12500, 'Images/TP-Link Archer AX73.jpeg')">Buy Now</button>
    </div>

    <!-- Product 2 -->
    <div class="product-card">
      <img src="Images/ASUS RT-AX82U.jpg" alt="Gaming Router">
      <h3>ASUS RT-AX82U</h3>
      <p>AX5400 dual-band WiFi 6, gaming port, RGB lighting, and ASUS AiMesh support for mesh networking.</p>
      <h4>₱14,500</h4>
      <button onclick="addToCart(702, 'ASUS RT-AX82U', 14500, 'Images/ASUS RT-AX82U.jpg')">Buy Now</button>
    </div>

    <!-- Product 3 -->
    <div class="product-card">
      <img src="Images/Netgear Nighthawk RAX50.jpg" alt="WiFi Router">
      <h3>Netgear Nighthawk RAX50</h3>
      <p>AX5400 WiFi 6 speed, 4-stream performance, smart connect, and support for 40+ devices simultaneously.</p>
      <h4>₱12,800</h4>
      <button onclick="addToCart(703, 'Netgear Nighthawk RAX50', 12800, 'Images/Netgear Nighthawk RAX50.jpg')">Buy Now</button>
    </div>

    <!-- Product 4 -->
    <div class="product-card">
      <img src="Images/TP-Link Deco X60.jpg" alt="Mesh Router">
      <h3>TP-Link Deco X60</h3>
      <p>AX3000 whole-home mesh WiFi 6 system, covers up to 5,800 sq.ft., and supports 150+ devices.</p>
      <h4>₱13,500</h4>
      <button onclick="addToCart(704, 'TP-Link Deco X60', 13500, 'Images/TP-Link Deco X60.jpg')">Buy Now</button>
    </div>

    <!-- Product 5 -->
    <div class="product-card">
      <img src="Images/ASUS TUF Gaming AX5400.jpg" alt="Gaming Router">
      <h3>ASUS TUF Gaming AX5400</h3>
      <p>Military-grade durability, WiFi 6, gaming acceleration, and dedicated gaming port for lag-free experience.</p>
      <h4>₱13,800</h4>
      <button onclick="addToCart(705, 'ASUS TUF Gaming AX5400', 13800, 'Images/ASUS TUF Gaming AX5400.jpg')">Buy Now</button>
    </div>

    <!-- Product 6 -->
    <div class="product-card">
      <img src="Images/D-Link DIR-X5460.jpg" alt="WiFi Router">
      <h3>D-Link DIR-X5460</h3>
      <p>AX5400 WiFi 6 router, intelligent QoS, advanced security features, and easy setup with mobile app.</p>
      <h4>₱11,500</h4>
      <button onclick="addToCart(706, 'D-Link DIR-X5460', 11500, 'Images/D-Link DIR-X5460.jpg')">Buy Now</button>
    </div>

    <!-- Product 7 -->
    <div class="product-card">
      <img src="Images/Linksys Atlas Pro 6.jpg" alt="Mesh Router">
      <h3>Linksys Atlas Pro 6</h3>
      <p>AX5400 mesh WiFi 6 system, intelligent mesh technology, and seamless roaming throughout your home.</p>
      <h4>₱14,000</h4>
      <button onclick="addToCart(707, 'Linksys Atlas Pro 6', 14000, 'Images/Linksys Atlas Pro 6.jpg')">Buy Now</button>
    </div>

    <!-- Product 8 -->
    <div class="product-card">
      <img src="Images/Xiaomi AX6000.jpg" alt="WiFi Router">
      <h3>Xiaomi AX6000</h3>
      <p>Next-gen WiFi 6 technology, 6000Mbps total speed, 6 high-performance antennas, and affordable pricing.</p>
      <h4>₱11,800</h4>
      <button onclick="addToCart(708, 'Xiaomi AX6000', 11800, 'Images/Xiaomi AX6000.jpg')">Buy Now</button>
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