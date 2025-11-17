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
  <title>Headsets - PCVerse</title>
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
    <h1>Explore Our Headset Collection</h1>
    <p>Discover immersive gaming headsets with surround sound, noise-cancelling microphones, and comfortable designs between ₱1,500 – ₱5,000.</p>
  </div>

  <!-- Back Button -->
  <div class="back-btn-container">
    <button class="back-btn" onclick="window.location.href='product.php'">← Back to Products</button>
  </div>

  <!-- Product Grid -->
  <div class="content-container">

    <!-- Product 1 -->
    <div class="product-card">
      <img src="Images/Razer Kraken X.jpg" alt="Gaming Headset">
      <h3>Razer Kraken X</h3>
      <p>7.1 surround sound, lightweight design, bendable noise-cancelling microphone, and comfortable ear cushions.</p>
      <h4>₱2,800</h4>
      <button onclick="addToCart(101, 'Razer Kraken X', 2800, 'Images/Razer Kraken X.jpg')">Buy Now</button>
    </div>

    <!-- Product 2 -->
    <div class="product-card">
      <img src="Images/Logitech G432.jpg" alt="Gaming Headset">
      <h3>Logitech G432</h3>
      <p>DTS 7.1 surround sound, 6mm flip-to-mute microphone, and comfortable over-ear design for long gaming sessions.</p>
      <h4>₱2,500</h4>
      <button onclick="addToCart(102, 'Logitech G432', 2500, 'Images/Logitech G432.jpg')">Buy Now</button>
    </div>

    <!-- Product 3 -->
    <div class="product-card">
      <img src="Images/HyperX Cloud Stinger.jpg" alt="Gaming Headset">
      <h3>HyperX Cloud Stinger</h3>
      <p>Lightweight gaming headset with 50mm directional drivers, swivel-to-mute noise cancellation, and intuitive volume control.</p>
      <h4>₱1,800</h4>
      <button onclick="addToCart(103, 'HyperX Cloud Stinger', 1800, 'Images/HyperX Cloud Stinger.jpg')">Buy Now</button>
    </div>

    <!-- Product 4 -->
    <div class="product-card">
      <img src="Images/SteelSeries Arctis 3.jpg" alt="Gaming Headset">
      <h3>SteelSeries Arctis 3</h3>
      <p>Console-grade audio quality, ClearCast noise-cancelling microphone, and comfortable ski goggle suspension headband.</p>
      <h4>₱3,000</h4>
      <button onclick="addToCart(104, 'SteelSeries Arctis 3', 3000, 'Images/SteelSeries Arctis 3.jpg')">Buy Now</button>
    </div>

    <!-- Product 5 -->
    <div class="product-card">
      <img src="Images/Rakk Kapsul.jpg" alt="Gaming Headset">
      <h3>Rakk Kapsul</h3>
      <p>Local brand favorite with 7.1 virtual surround sound, RGB lighting, and adjustable headband for maximum comfort.</p>
      <h4>₱1,500</h4>
      <button onclick="addToCart(105, 'Rakk Kapsul', 1500, 'Images/Rakk Kapsul.jpg')">Buy Now</button>
    </div>

    <!-- Product 6 -->
    <div class="product-card">
      <img src="Images/Fantech HG11.jpg" alt="Gaming Headset">
      <h3>Fantech HG11</h3>
      <p>50mm high-quality drivers, omnidirectional microphone, RGB lighting effects, and soft protein ear cushions.</p>
      <h4>₱2,300</h4>
      <button onclick="addToCart(106, 'Fantech HG11', 2300, 'Images/Fantech HG11.jpg')">Buy Now</button>
    </div>

    <!-- Product 7 -->
    <div class="product-card">
      <img src="Images/Logitech G435 Wireless.jpg" alt="Wireless Headset">
      <h3>Logitech G435 Wireless</h3>
      <p>LIGHTSPEED and Bluetooth connectivity, built-in microphone, lightweight design, and up to 18-hour battery life.</p>
      <h4>₱3,500</h4>
      <button onclick="addToCart(107, 'Logitech G435 Wireless', 3500, 'Images/Logitech G435 Wireless.jpg')">Buy Now</button>
    </div>

    <!-- Product 8 -->
    <div class="product-card">
      <img src="Images/Corsair HS65 Surround.jpg" alt="Premium Headset">
      <h3>Corsair HS65 Surround</h3>
      <p>Custom-tuned 50mm neodymium audio drivers, Dolby Audio 7.1 surround sound, and memory foam ear pads.</p>
      <h4>₱5,000</h4>
      <button onclick="addToCart(108, 'Corsair HS65 Surround', 5000, 'Images/Corsair HS65 Surround.jpg')">Buy Now</button>
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