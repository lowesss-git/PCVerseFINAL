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
    
    // Include your Database class from config directory
    include 'config/database.php';
    
    // Initialize variables
    $success_message = "";
    $error_message = "";
    
    // Create database connection using your Database class
    $database = new Database();
    $db = $database->getConnection();
    
    // Fetch current user data to initialize form values
    try {
        $query = "SELECT username, email FROM users WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $username = $user['username'];
            $email = $user['email'];
            // Update session variables to ensure they're current
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
        } else {
            // User not found in database
            session_destroy();
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        $error_message = "Unable to fetch user data.";
        $username = "";
        $email = "";
    }
    
    // Process form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_username = trim($_POST['username']);
        $new_email = trim($_POST['email']);
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Basic validation
        if (empty($new_username) || empty($new_email)) {
            $error_message = "Username and email are required.";
        } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Please enter a valid email address.";
        } else {
            try {
                // Verify current password if changing password
                if (!empty($new_password)) {
                    if ($new_password !== $confirm_password) {
                        $error_message = "New passwords do not match.";
                    } else {
                        // Verify current password
                        $query = "SELECT password FROM users WHERE id = ?";
                        $stmt = $db->prepare($query);
                        $stmt->execute([$_SESSION['user_id']]);
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if (!$user || !password_verify($current_password, $user['password'])) {
                            $error_message = "Current password is incorrect.";
                        }
                    }
                }
                
                // If no errors, update the account
                if (empty($error_message)) {
                    if (!empty($new_password)) {
                        // Update with new password
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $query = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
                        $stmt = $db->prepare($query);
                        $stmt->execute([$new_username, $new_email, $hashed_password, $_SESSION['user_id']]);
                    } else {
                        // Update without changing password
                        $query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
                        $stmt = $db->prepare($query);
                        $stmt->execute([$new_username, $new_email, $_SESSION['user_id']]);
                    }
                    
                    // Update session variables
                    $_SESSION['username'] = $new_username;
                    $_SESSION['email'] = $new_email;
                    
                    $success_message = "Account updated successfully!";
                    $username = $new_username;
                    $email = $new_email;
                }
                
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) { // Duplicate entry
                    $error_message = "Username or email already exists.";
                } else {
                    $error_message = "An error occurred. Please try again.";
                }
            }
        }
    }
        // Handle account deletion
    if (isset($_POST['delete_account'])) {
        $delete_confirmation = isset($_POST['delete_confirmation']) ? $_POST['delete_confirmation'] : '';
        
        if (!$delete_confirmation) {
            $error_message = "Please confirm that you understand this action is irreversible.";
        } else {
            try {
                // Start transaction
                $db->beginTransaction();
                
                // Get user info before deletion
                $query = "SELECT username, email FROM users WHERE id = ?";
                $stmt = $db->prepare($query);
                $stmt->execute([$_SESSION['user_id']]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $user_email = $user['email'];
                
                // Anonymize user's orders instead of deleting (for business records)
                try {
                    $query = "UPDATE orders SET 
                             customer_name = 'Deleted User', 
                             customer_email = 'deleted@example.com',
                             customer_phone = '000-000-0000'
                             WHERE customer_email = ?";
                    $stmt = $db->prepare($query);
                    $stmt->execute([$user_email]);
                } catch (Exception $e) {
                    // Ignore errors if orders table doesn't exist
                    error_log("Note: Could not anonymize orders: " . $e->getMessage());
                }
                
                // Delete cart items if cart table exists
                try {
                    $stmt = $db->query("SHOW TABLES LIKE 'cart'");
                    if ($stmt->rowCount() > 0) {
                        $stmt = $db->query("SHOW COLUMNS FROM cart LIKE 'user_id'");
                        if ($stmt->rowCount() > 0) {
                            $query = "DELETE FROM cart WHERE user_id = ?";
                            $stmt = $db->prepare($query);
                            $stmt->execute([$_SESSION['user_id']]);
                        }
                    }
                } catch (Exception $e) {
                    // Ignore errors
                    error_log("Note: Could not delete from cart: " . $e->getMessage());
                }
                
                // Delete the user account
                $query = "DELETE FROM users WHERE id = ?";
                $stmt = $db->prepare($query);
                $stmt->execute([$_SESSION['user_id']]);
                
                // Commit transaction
                $db->commit();
                
                // Destroy session and redirect
                session_destroy();
                header("Location: account_deleted.php");
                exit();
                
            } catch (PDOException $e) {
                // Rollback transaction on error
                $db->rollBack();
                $error_message = "An error occurred while deleting your account. Please try again.";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account - PCVerse</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .update-account-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background: #faeccf;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .update-account-container h2 {
            text-align: center;
            color: #693F26;
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #3B2415;
            font-weight: bold;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #d6c2a5;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #693F26;
        }
        
        .btn-update {
            background: #693F26;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
            display: block;
            width: 100%;
            margin-top: 20px;
        }
        
        .btn-update:hover {
            background: #3B2415;
            transform: scale(1.02);
        }
        
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .password-section {
            border-top: 2px solid #d6c2a5;
            padding-top: 20px;
            margin-top: 20px;
        }
        
        .password-section h3 {
            color: #693F26;
            margin-bottom: 15px;
        }
                .delete-section {
            border-top: 2px solid #dc3545;
            padding-top: 20px;
            margin-top: 30px;
        }
        
        .delete-section h3 {
            color: #dc3545;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        
        .delete-label {
            color: #dc3545 !important;
            font-size: 1.1rem;
        }
        
        .delete-warning {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 6px;
            border-left: 4px solid #dc3545;
            margin: 10px 0;
            font-size: 0.9rem;
        }
        
        .delete-confirmation {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
            padding: 10px;
            background: #fff5f5;
            border-radius: 6px;
        }
        
        .delete-confirmation input[type="checkbox"] {
            width: auto;
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
            width: auto;
            margin-top: 10px;
        }
        
        .btn-delete:hover {
            background: #c82333;
            transform: scale(1.05);
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

    <div class="update-account-container">
        <h2><i class="fa fa-user-edit"></i> Update Account</h2>
        
        <?php if ($success_message): ?>
            <div class="message success">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="message error">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="password-section">
                <h3>Change Password (Optional)</h3>
                
                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" placeholder="Enter current password to change it">
                </div>
                
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Enter new password">
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
                </div>
            </div>
            
            <button type="submit" class="btn-update">
                <i class="fa fa-save"></i> Update Account
            </button>
                        <div class="delete-section">
                <h3><i class="fa fa-exclamation-triangle"></i> Danger Zone</h3>
                
                <div class="form-group">
                    <label for="delete_confirmation" class="delete-label">
                        <i class="fa fa-trash"></i> Delete Account Permanently
                    </label>
                    <p class="delete-warning">
                        <strong>Warning:</strong> This action cannot be undone. All your data, including order history and personal information, will be permanently deleted.
                    </p>
                    <div class="delete-confirmation">
                        <input type="checkbox" id="delete_confirmation" name="delete_confirmation" value="1">
                        <label for="delete_confirmation">I understand that this action is irreversible</label>
                    </div>
                    <button type="submit" name="delete_account" class="btn-delete" onclick="return confirmDelete()">
                        <i class="fa fa-trash"></i> Delete My Account
                    </button>
                </div>
            </div>
        </form>
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
    
    <script>
        // Simple password validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const currentPassword = document.getElementById('current_password').value;
            
            // If new password is provided but current password is empty
            if (newPassword && !currentPassword) {
                e.preventDefault();
                alert('Please enter your current password to change it.');
                return;
            }
            
            // If new password doesn't match confirmation
            if (newPassword && newPassword !== confirmPassword) {
                e.preventDefault();
                alert('New passwords do not match.');
                return;
            }
        });
                function confirmDelete() {
            const confirmation = document.getElementById('delete_confirmation').checked;
            if (!confirmation) {
                alert('Please check the confirmation box to confirm you understand this action is irreversible.');
                return false;
            }
            return confirm('ARE YOU ABSOLUTELY SURE?\n\nThis will permanently delete your account and all associated data. This action cannot be undone!');
        }
    </script>
</body>
</html>