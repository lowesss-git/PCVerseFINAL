<?php 
    // Start session to access user data
    if (session_status() == PHP_SESSION_NONE) { 
        session_start(); 
    }
    
    // Redirect to login if not logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    
    // Include the file containing the getCartCount() function
    include 'includes/cart_functions.php'; 
    $cart_count = getCartCount();
    
    // Include your Database class
    include 'config/database.php';
    
    // Initialize variables
    $user_data = [];
    $error_message = "";
    
    // Create database connection using your Database class
    $database = new Database();
    $db = $database->getConnection();
    
    // Fetch user data
    try {
        $query = "SELECT username, email, created_at FROM users WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$_SESSION['user_id']]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user_data) {
            // User not found in database
            session_destroy();
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        $error_message = "Unable to fetch user data.";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - PCVerse</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background: #faeccf;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .profile-container h2 {
            text-align: center;
            color: #693F26;
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            background: #693F26;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 2.5rem;
        }
        
        .profile-info {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .info-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .info-group:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: bold;
            color: #3B2415;
            min-width: 120px;
        }
        
        .info-value {
            color: #495057;
            text-align: right;
            flex: 1;
        }
        
        .profile-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }
        
        .btn-profile {
            background: #693F26;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-profile:hover {
            background: #3B2415;
            transform: scale(1.05);
            color: white;
        }
        
        .btn-edit {
            background: #693F26;
        }
        
        .btn-home {
            background: #693F26;
        }
        
        .member-since {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
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

    <div class="profile-container">
        <h2><i class="fa fa-user"></i> My Profile</h2>
        
        <?php if ($error_message): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fa fa-user"></i>
            </div>
            <h3><?php echo htmlspecialchars($user_data['username']); ?></h3>
            <p>PCVerse Member</p>
        </div>
        
        <div class="profile-info">
            <div class="info-group">
                <span class="info-label"><i class="fa fa-user"></i> Username:</span>
                <span class="info-value"><?php echo htmlspecialchars($user_data['username']); ?></span>
            </div>
            
            <div class="info-group">
                <span class="info-label"><i class="fa fa-envelope"></i> Email:</span>
                <span class="info-value"><?php echo htmlspecialchars($user_data['email']); ?></span>
            </div>
            
            <div class="info-group">
                <span class="info-label"><i class="fa fa-id-card"></i> User ID:</span>
                <span class="info-value">#<?php echo $_SESSION['user_id']; ?></span>
            </div>
        </div>
        
        <?php if ($user_data['created_at']): ?>
        <div class="member-since">
            <i class="fa fa-calendar"></i> 
            Member since: <?php echo date('F j, Y', strtotime($user_data['created_at'])); ?>
        </div>
        <?php endif; ?>
        
        <div class="profile-actions">
            <a href="update_account.php" class="btn-profile btn-edit">
                <i class="fa fa-edit"></i> Edit Profile
            </a>
            <a href="Home.php" class="btn-profile btn-home">
                <i class="fa fa-home"></i> Back to Home
            </a>
        </div>
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