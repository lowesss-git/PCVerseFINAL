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
  <title>Keyboards - PCVerse</title>
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
    <h1>Explore Our Keyboard Collection</h1>
    <p>Discover premium mechanical and membrane keyboards between ₱1,000 – ₱5,000.</p>
  </div>

  <!-- Back Button -->
  <div class="back-btn-container">
    <button class="back-btn" onclick="window.location.href='product.php'">← Back to Products</button>
  </div>

  <!-- Product Grid -->
  <div class="content-container">

    <!-- Product 1 -->
    <div class="product-card">
      <img src="Images/Rakk Ilis Mechanical Keyboard.jpg" alt="Keyboard">
      <h3>Rakk Ilis Mechanical Keyboard</h3>
      <p>Durable mechanical switches with RGB backlighting and ergonomic design.</p>
      <h4>₱2,500</h4>
      <button onclick="addToCart(301, 'Rakk Ilis Mechanical Keyboard', 2500, 'Images/Rakk Ilis Mechanical Keyboard.jpg')">Buy Now</button>
    </div>

    <!-- Product 2 -->
    <div class="product-card">
      <img src="Images/Redragon K552 Kumara.jpg" alt="Keyboard">
      <h3>Redragon K552 Kumara</h3>
      <p>Compact 87-key layout, clicky blue switches, and full RGB customization.</p>
      <h4>₱1,800</h4>
      <button onclick="addToCart(302, 'Redragon K552 Kumara', 1800, 'Images/Redragon K552 Kumara.jpg')">Buy Now</button>
    </div>

    <!-- Product 3 -->
    <div class="product-card">
      <img src="Images/Logitech K845 Mechanical.jpg" alt="Keyboard">
      <h3>Logitech K845 Mechanical</h3>
      <p>Slim aluminum design with quiet switches — built for comfort and productivity.</p>
      <h4>₱4,500</h4>
      <button onclick="addToCart(303, 'Logitech K845 Mechanical', 4500, 'Images/Logitech K845 Mechanical.jpg')">Buy Now</button>
    </div>

    <!-- Product 4 -->
    <div class="product-card">
      <img src="Images/A4Tech Bloody B500N.jpg" alt="Keyboard">
      <h3>A4Tech Bloody B500N</h3>
      <p>Water-resistant design, fast optical switches, and anti-ghosting performance.</p>
      <h4>₱2,200</h4>
      <button onclick="addToCart(304, 'A4Tech Bloody B500N', 2200, 'Images/A4Tech Bloody B500N.jpg')">Buy Now</button>
    </div>

    <!-- Product 5 -->
    <div class="product-card">
      <img src="Images/Fantech Maxfit67 RGB.jpg" alt="Keyboard">
      <h3>Fantech Maxfit67 RGB</h3>
      <p>Compact 65% keyboard with hot-swappable switches and customizable effects.</p>
      <h4>₱2,800</h4>
      <button onclick="addToCart(305, 'Fantech Maxfit67 RGB', 2800, 'Images/Fantech Maxfit67 RGB.jpg')">Buy Now</button>
    </div>

    <!-- Product 6 -->
    <div class="product-card">
      <img src="Images/Razer Cynosa V2.jpg" alt="Keyboard">
      <h3>Razer Cynosa V2</h3>
      <p>Soft-touch membrane keys with full RGB lighting and dedicated media controls.</p>
      <h4>₱4,800</h4>
      <button onclick="addToCart(306, 'Razer Cynosa V2', 4800, 'Images/Razer Cynosa V2.jpg')">Buy Now</button>
    </div>

    <!-- Product 7 -->
    <div class="product-card">
      <img src="Images/Logitech K380 Wireless.jpg" alt="Keyboard">
      <h3>Logitech K380 Wireless</h3>
      <p>Multi-device Bluetooth keyboard with quiet, responsive keys and long battery life.</p>
      <h4>₱1,500</h4>
      <button onclick="addToCart(307, 'Logitech K380 Wireless', 1500, 'Images/Logitech K380 Wireless.jpg')">Buy Now</button>
    </div>

    <!-- Product 8 -->
    <div class="product-card">
      <img src="Images/Royal Kludge RK61.jpg" alt="Keyboard">
      <h3>Royal Kludge RK61</h3>
      <p>60% mechanical keyboard with dual Bluetooth and USB-C connectivity.</p>
      <h4>₱3,000</h4>
      <button onclick="addToCart(308, 'Royal Kludge RK61', 3000, 'Images/Royal Kludge RK61.jpg')">Buy Now</button>
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