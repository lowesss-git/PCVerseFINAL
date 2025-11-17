
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
  <title>Mice - PCVerse</title>
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
    <h1>Explore Our Mouse Collection</h1>
    <p>Discover high-precision gaming mice with customizable DPI, RGB lighting, and ergonomic designs between ₱500 – ₱2,000.</p>
  </div>

  <!-- Back Button -->
  <div class="back-btn-container">
    <button class="back-btn" onclick="window.location.href='product.php'">← Back to Products</button>
  </div>

  <!-- Product Grid -->
  <div class="content-container">

    <!-- Product 1 -->
    <div class="product-card">
      <img src="Images/Razer DeathAdder Essential.jpg" alt="Gaming Mouse">
      <h3>Razer DeathAdder Essential</h3>
      <p>6,400 DPI optical sensor, 5 programmable buttons, and ergonomic right-handed design.</p>
      <h4>₱1,200</h4>
      <button onclick="addToCart(201, 'Razer DeathAdder Essential', 1200, 'Images/Razer DeathAdder Essential.jpg')">Buy Now</button>
    </div>

    <!-- Product 2 -->
    <div class="product-card">
      <img src="Images/Logitech G102 Lightsync.jpg" alt="Gaming Mouse">
      <h3>Logitech G102 Lightsync</h3>
      <p>8,000 DPI sensor, RGB lighting, 6 programmable buttons with classic ambidextrous shape.</p>
      <h4>₱1,200</h4>
      <button onclick="addToCart(202, 'Logitech G102 Lightsync', 1200, 'Images/Logitech G102 Lightsync.jpg')">Buy Now</button>
    </div>

    <!-- Product 3 -->
    <div class="product-card">
      <img src="Images/Redragon M711 Cobra.jpg" alt="Gaming Mouse">
      <h3>Redragon M711 Cobra</h3>
      <p>10,000 DPI optical sensor, 7 programmable buttons, RGB lighting with firestorm software.</p>
      <h4>₱900</h4>
      <button onclick="addToCart(203, 'Redragon M711 Cobra', 900, 'Images/Redragon M711 Cobra.jpg')">Buy Now</button>
    </div>

    <!-- Product 4 -->
    <div class="product-card">
      <img src="Images/SteelSeries Rival 3.jpg" alt="Gaming Mouse">
      <h3>SteelSeries Rival 3</h3>
      <p>8,500 CPI TrueMove Core sensor, 3-zone RGB lighting, 60 million click mechanical switches.</p>
      <h4>₱1,300</h4>
      <button onclick="addToCart(204, 'SteelSeries Rival 3', 1300, 'Images/SteelSeries Rival 3.jpg')">Buy Now</button>
    </div>

    <!-- Product 5 -->
    <div class="product-card">
      <img src="Images/Rakk Kaptan.jpg" alt="Gaming Mouse">
      <h3>Rakk Kaptan</h3>
      <p>Local favorite with 6,400 DPI, 7 programmable buttons, and durable build quality.</p>
      <h4>₱600</h4>
      <button onclick="addToCart(205, 'Rakk Kaptan', 600, 'Images/Rakk Kaptan.jpg')">Buy Now</button>
    </div>

    <!-- Product 6 -->
    <div class="product-card">
      <img src="Images/Fantech X9 Thor.jpg" alt="Gaming Mouse">
      <h3>Fantech X9 Thor</h3>
      <p>3,200 DPI optical sensor, 6 buttons, RGB breathing light, perfect for entry-level gaming.</p>
      <h4>₱500</h4>
      <button onclick="addToCart(206, 'Fantech X9 Thor', 500, 'Images/Fantech X9 Thor.jpg')">Buy Now</button>
    </div>

    <!-- Product 7 -->
    <div class="product-card">
      <img src="Images/Logitech G304 Lightspeed.jpg" alt="Wireless Mouse">
      <h3>Logitech G304 Lightspeed</h3>
      <p>Wireless gaming mouse with 12,000 DPI HERO sensor and 250-hour battery life.</p>
      <h4>₱1,500</h4>
      <button onclick="addToCart(207, 'Logitech G304 Lightspeed', 1500, 'Images/Logitech G304 Lightspeed.jpg')">Buy Now</button>
    </div>

    <!-- Product 8 -->
    <div class="product-card">
      <img src="Images/A4Tech Bloody V7.jpg" alt="Gaming Mouse">
      <h3>A4Tech Bloody V7</h3>
      <p>3,200 DPI with 3 adjustable levels, 7 buttons, and ergonomic comfort grip design.</p>
      <h4>₱1,100</h4>
      <button onclick="addToCart(208, 'A4Tech Bloody V7', 1100, 'Images/A4Tech Bloody V7.jpg')">Buy Now</button>
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