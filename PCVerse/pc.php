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
  <title>Custom PCs - PCVerse</title>
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

  <!-- Welcome Banner -->
  <div class="welcome">
    <h1>Explore Our Custom PC Collection</h1>
    <p>Build your dream setup with premium components, RGB lighting, and advanced cooling systems between ₱35,000 – ₱60,000.</p>
  </div>

  <!-- Back Button -->
  <div class="back-btn-container">
    <button class="back-btn" onclick="window.location.href='product.php'">← Back to Products</button>
  </div>

  <!-- Product Grid -->
  <div class="content-container">

    <!-- Product 1 -->
    <div class="product-card">
      <img src="Images/PCVerse Starter Pro.jpg" alt="Gaming PC">
      <h3>PCVerse Starter Pro</h3>
      <p>AMD Ryzen 5 5600X, RTX 3060, 16GB RAM, 512GB SSD, 650W PSU - Perfect for 1080p gaming and streaming.</p>
      <h4>₱35,000</h4>
      <button onclick="addToCart(601, 'PCVerse Starter Pro', 35000, 'Images/PCVerse Starter Pro.jpg')">Buy Now</button>
    </div>

    <!-- Product 2 -->
    <div class="product-card">
      <img src="Images/PCVerse Performance Elite.jpg" alt="Gaming PC">
      <h3>PCVerse Performance Elite</h3>
      <p>Intel i5-12400F, RTX 4060, 16GB DDR4, 1TB NVMe SSD, AIO cooler - Balanced performance for gaming and work.</p>
      <h4>₱42,000</h4>
      <button onclick="addToCart(602, 'PCVerse Performance Elite', 42000, 'Images/PCVerse Performance Elite.jpg')">Buy Now</button>
    </div>

    <!-- Product 3 -->
    <div class="product-card">
      <img src="Images/PCVerse RGB Phantom.jpg" alt="Gaming PC">
      <h3>PCVerse RGB Phantom</h3>
      <p>AMD Ryzen 7 5700X, RTX 4070, 32GB RAM, 1TB SSD, 750W Gold PSU, ARGB fans - Stunning visuals and power.</p>
      <h4>₱55,000</h4>
      <button onclick="addToCart(603, 'PCVerse RGB Phantom', 55000, 'Images/PCVerse RGB Phantom.jpg')">Buy Now</button>
    </div>

    <!-- Product 4 -->
    <div class="product-card">
      <img src="Images/PCVerse Stream Master.jpg" alt="Streaming PC">
      <h3>PCVerse Stream Master</h3>
      <p>Intel i7-12700K, RTX 4060 Ti, 32GB RAM, 2TB SSD, dual monitor support - Optimized for content creators.</p>
      <h4>₱52,000</h4>
      <button onclick="addToCart(604, 'PCVerse Stream Master', 52000, 'Images/PCVerse Stream Master.jpg')">Buy Now</button>
    </div>

    <!-- Product 5 -->
    <div class="product-card">
      <img src="Images/PCVerse Ultimate Beast.jpg" alt="Premium Gaming PC">
      <h3>PCVerse Ultimate Beast</h3>
      <p>AMD Ryzen 7 7700X, RTX 4070 Ti, 32GB DDR5, 2TB NVMe, 850W PSU - High-end gaming at 1440p/4K.</p>
      <h4>₱55,000</h4>
      <button onclick="addToCart(605, 'PCVerse Ultimate Beast', 55000, 'Images/PCVerse Ultimate Beast.jpg')">Buy Now</button>
    </div>

    <!-- Product 6 -->
    <div class="product-card">
      <img src="Images/PCVerse Mini Titan.jpg" alt="Compact PC">
      <h3>PCVerse Mini Titan</h3>
      <p>Intel i5-13400, RTX 4060, 16GB RAM, 1TB SSD, Mini-ITX case - Powerful performance in compact form.</p>
      <h4>₱45,000</h4>
      <button onclick="addToCart(606, 'PCVerse Mini Titan', 45000, 'Images/PCVerse Mini Titan.jpg')">Buy Now</button>
    </div>

    <!-- Product 7 -->
    <div class="product-card">
      <img src="Images/PCVerse Pro Creator.jpg" alt="Workstation PC">
      <h3>PCVerse Pro Creator</h3>
      <p>AMD Ryzen 9 5900X, RTX 4070, 64GB RAM, 2TB SSD + 4TB HDD - For video editing and 3D rendering.</p>
      <h4>₱52,000</h4>
      <button onclick="addToCart(607, 'PCVerse Pro Creator', 52000, 'Images/PCVerse Pro Creator.jpg')">Buy Now</button>
    </div>

    <!-- Product 8 -->
    <div class="product-card">
      <img src="Images/PCVerse Neon Spectra.jpg" alt="RGB Gaming PC">
      <h3>PCVerse Neon Spectra</h3>
      <p>Intel i7-13700F, RTX 4070 Super, 32GB RAM, 2TB SSD, liquid cooling, full ARGB ecosystem.</p>
      <h4>₱49,000</h4>
      <button onclick="addToCart(608, 'PCVerse Neon Spectra', 49000, 'Images/PCVerse Neon Spectra.jpg')">Buy Now</button>
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