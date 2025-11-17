<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: Home.php");
    exit();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_or_email = trim($_POST['username_or_email']);
    $password = $_POST['password'];

    // Check if database file exists
    if (!file_exists('config/database.php')) {
        $error_message = "Database configuration not found. Please contact administrator.";
    } else {
        include 'config/database.php';
        
        try {
            $database = new Database();
            $db = $database->getConnection();
            
            // Check if connection was successful
            if ($db === null) {
                $error_message = "Unable to connect to database. Please try again later.";
            } else {
                $query = "SELECT id, username, password FROM users WHERE username = :login OR email = :login LIMIT 1";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':login', $username_or_email);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    
                    // Check for pending redirect
                    if (isset($_SESSION['redirect_url'])) {
                        $redirect_url = $_SESSION['redirect_url'];
                        unset($_SESSION['redirect_url']);
                        header("Location: " . $redirect_url);
                    } else {
                        header("Location: Home.php");
                    }
                    exit();
                } else {
                    $error_message = "Invalid username/email or password.";
                }
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        } catch (Exception $e) {
            $error_message = "An error occurred: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - PCVerse</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #d6c2a5, #f4e1c6);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .login-box {
      position: relative;
      width: 380px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      padding: 40px 30px;
      text-align: center;
    }

    .login-box h1 {
      color: #693f26;
      font-size: 2rem;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .login-box h2 {
      color: #8f723d;
      font-size: 1.2rem;
      margin-bottom: 25px;
    }

    form input {
      width: 100%;
      padding: 12px 14px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      outline: none;
      transition: border-color 0.3s;
    }

    form input:focus {
      border-color: #8f723d;
    }

    button {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      background: #693f26;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: 0.3s ease;
    }

    button:hover {
      background: #3b2415;
      transform: scale(1.03);
    }

    .error {
      color: #c0392b;
      background: #fbeaea;
      padding: 8px;
      border-radius: 6px;
      font-size: 0.9rem;
      margin-bottom: 10px;
    }

    .login-footer {
      text-align: center;
      margin-top: 20px;
      font-size: 0.9rem;
      color: #333;
    }

    .login-footer a {
      color: #8f723d;
      text-decoration: none;
      font-weight: bold;
    }

    .login-footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h1>PCVerse</h1>
    <h2><i class="fa-solid fa-right-to-bracket"></i> Sign In</h2>

    <?php if ($error_message): ?>
      <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
      <input type="text" name="username_or_email" placeholder="Username or Email"
             value="<?php echo htmlspecialchars($_POST['username_or_email'] ?? ''); ?>" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Log In</button>
    </form>

    <div class="login-footer">
      <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
  </div>
</body>
</html>