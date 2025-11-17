<?php 
    // Start session
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
    <title>Account Deleted - PCVerse</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .deletion-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            background: #faeccf;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            text-align: center;
        }
        
        .deletion-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 20px;
        }
        
        .deletion-container h2 {
            color: #693F26;
            margin-bottom: 20px;
            font-size: 2rem;
        }
        
        .deletion-message {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #c3e6cb;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }
        
        .btn-home {
            background: #693F26;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-home:hover {
            background: #3B2415;
            transform: scale(1.05);
            color: white;
        }
    </style>
</head>
<body>
    
    <header class="">
        <div style="text-align: left;">
            <div class="container">
                <h1>PCVerse</h1>
                <div class="header-right">
                    <div class="search-bar">
                        <input type="text" placeholder="Search...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
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
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li>
                <a href="cart.php">
                    <i class="fa fa-shopping-cart"></i> 
                    Cart (<?php echo $cart_count; ?>)
                </a>
            </li>
        </ul>
    </nav>

    <div class="deletion-container">
        <div class="deletion-icon">
            <i class="fa fa-check-circle"></i>
        </div>
        
        <h2>Account Successfully Deleted</h2>
        
        <div class="deletion-message">
            <p><strong>Your account has been permanently deleted.</strong></p>
            <p>All your personal information and data have been removed from our systems.</p>
            <p>We're sorry to see you go!</p>
        </div>
        
        <a href="Home.php" class="btn-home">
            <i class="fa fa-home"></i> Back to Homepage
        </a>
    </div>

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
</body>
</html>