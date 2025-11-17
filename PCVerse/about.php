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
  <title>About Us - PCVerse</title>
  <link rel="stylesheet" href="css/style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="page-transition"></div>
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
  <!-- About Section -->
  <section class="about">
    <h2>Who We Are</h2>
    <p>
      At <b>PCVerse</b>, we’re not just a tech store—we’re your partner in innovation.  
      We specialize in high-quality computer parts, accessories, and gaming gear designed to inspire creativity and maximize performance.  
      Whether you’re a gamer, student, or professional, we’ve got you covered with stylish, affordable, and powerful solutions.
      <br><br>
      Beyond selling products, we aim to build a community of tech enthusiasts who share the same love for innovation and progress.  
      Our goal is to make technology more accessible, exciting, and reliable for everyone—because at <b>PCVerse</b>, we believe the right tools can unlock limitless possibilities.
    </p>
  </section>

  <!-- Features Section -->
  <section class="features">
    <div class="feature-card">
      <h3>💡 Innovation</h3>
      <p>Cutting-edge processors, GPUs, and peripherals to keep you ahead in technology.</p>
    </div>
    <div class="feature-card">
      <h3>🎮 Gaming Gear</h3>
      <p>RGB keyboards, gaming mice, and pro headsets for the ultimate gaming experience.</p>
    </div>
    <div class="feature-card">
      <h3>🛠️ Custom Builds</h3>
      <p>Personalized PCs designed for gaming, work, or creativity—built to match your needs.</p>
    </div>
  </section>

  <!-- Mission Vision Goals -->
  <section class="mission-vision">
    <h2>Our Mission, Vision & Goal</h2>
    <div class="mv-container">
      <div class="mv-card">
        <h3>Mission</h3>
        <p>To empower gamers, students, and professionals with reliable computer solutions.</p>
      </div>
      <div class="mv-card">
        <h3>Vision</h3>
        <p>To be the ultimate hub for tech lovers—a place where innovation meets accessibility.</p>
      </div>
      <div class="mv-card">
        <h3>Goal</h3>
        <p>To deliver top-notch products, great customer service, and inspire a love for technology.</p>
      </div>
    </div>
  </section>

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
