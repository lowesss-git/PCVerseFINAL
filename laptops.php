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
  <title>Laptops - PCVerse</title>
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
    <h1>Explore Our Laptop Collection</h1>
    <p>Find the perfect laptop for gaming, school, or professional use — all between ₱50,000 – ₱100,000.</p>
  </div>

  <!-- Back Button -->
  <div class="back-btn-container">
    <button class="back-btn" onclick="window.location.href='product.php'">← Back to Products</button>
  </div>

  <!-- Product Grid -->
  <div class="content-container">

    <!-- Product 1 -->
    <div class="product-card">
      <img src="Images/asustufgaming.jpeg" alt="Gaming Laptop">
      <h3>ASUS TUF Gaming F15</h3>
      <p>Intel i7 12th Gen, RTX 3060, 16 GB RAM, 512 GB SSD — built for performance and durability.</p>
      <h4>₱90,000</h4>
      <button onclick="addToCart(401, 'ASUS TUF Gaming F15', 90000, 'Images/asustufgaming.jpeg')">Buy Now</button>
    </div>

    <!-- Product 2 -->
    <div class="product-card">
      <img src="Images/MSI Bravo 15.jpeg" alt="Laptop">
      <h3>MSI Bravo 15</h3>
      <p>AMD Ryzen 7 with Radeon graphics for smooth multitasking and gaming.</p>
      <h4>₱75,000</h4> 
      <button onclick="addToCart(402, 'MSI Bravo 15', 75000, 'Images/MSI Bravo 15.jpeg')">Buy Now</button>
    </div>

    <!-- Product 3 -->
    <div class="product-card">
      <img src="Images/Lenovo Legion 5.jpeg" alt="Laptop">
      <h3>Lenovo Legion 5</h3>
      <p>144 Hz display and GeForce RTX 3050 Ti GPU for fast and fluid visuals.</p>
      <h4>₱95,000</h4>
      <button onclick="addToCart(403, 'Lenovo Legion 5', 95000, 'Images/Lenovo Legion 5.jpeg')">Buy Now</button>
    </div>

    <!-- Product 4 -->
    <div class="product-card">
      <img src="Images/Acer Nitro 5.jpg" alt="Laptop">
      <h3>Acer Nitro 5</h3>
      <p>Reliable gaming laptop with Intel Core i5 and RTX 3050 graphics.</p>
      <h4>₱65,000</h4>
      <button onclick="addToCart(404, 'Acer Nitro 5', 65000, 'Images/Acer Nitro 5.jpg')">Buy Now</button>
    </div>

    <!-- Product 5 -->
    <div class="product-card">
      <img src="Images/HP Victus 15.jpg" alt="Laptop">
      <h3>HP Victus 15</h3>
      <p>Balanced performance and sleek design, ideal for gaming or study.</p>
      <h4>₱60,000</h4>
      <button onclick="addToCart(405, 'HP Victus 15', 60000, 'Images/HP Victus 15.jpg')">Buy Now</button>
    </div>

    <!-- Product 6 -->
    <div class="product-card">
      <img src="Images/ASUS Vivobook Pro 15.jpg" alt="Laptop">
      <h3>ASUS Vivobook Pro 15</h3>
      <p>Lightweight productivity laptop with AMD Ryzen 5 and NVIDIA graphics.</p>
      <h4>₱55,000</h4>
      <button onclick="addToCart(406, 'ASUS Vivobook Pro 15', 55000, 'Images/ASUS Vivobook Pro 15.jpg')">Buy Now</button>
    </div>

    <!-- Product 7 -->
    <div class="product-card">
      <img src="Images/Lenovo IdeaPad Gaming 3.jpg" alt="Laptop">
      <h3>Lenovo IdeaPad Gaming 3</h3>
      <p>Affordable yet powerful, with Ryzen 5 and GTX 1650 GPU.</p>
      <h4>₱50,000</h4>
      <button onclick="addToCart(407, 'Lenovo IdeaPad Gaming 3', 50000, 'Images/Lenovo IdeaPad Gaming 3.jpg')">Buy Now</button>
    </div>

    <!-- Product 8 -->
    <div class="product-card">
      <img src="Images/Acer Aspire 7.jpg" alt="Laptop">
      <h3>Acer Aspire 7</h3>
      <p>Perfect for students and professionals — AMD Ryzen 5 with GTX 1650.</p>
      <h4>₱65,000</h4>
      <button onclick="addToCart(408, 'Acer Aspire 7', 65000, 'Images/Acer Aspire 7.jpg')">Buy Now</button>
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