<?php
session_start();
include 'config/database.php';

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters.";
    } else {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $error_message = "Username or email is already taken.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $insert_stmt = $db->prepare($insert_query);
            $insert_stmt->bindParam(':username', $username);
            $insert_stmt->bindParam(':email', $email);
            $insert_stmt->bindParam(':password', $hashed_password);

            if ($insert_stmt->execute()) {
                $success_message = "Registration successful! You can now <a href='login.php'>log in</a>.";
                unset($_POST);
            } else {
                $error_message = "Registration failed. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - PCVerse</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body {
  font-family: Arial, sans-serif;
  background: linear-gradient(135deg, #d6c2a5, #f4e1c6);
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}
.auth-box {
  width: 380px;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  padding: 40px 30px;
  text-align: center;
}
.auth-box h1 {
  color: #693f26;
  font-size: 2rem;
  margin-bottom: 10px;
  font-weight: bold;
}
.auth-box h2 {
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
form input:focus { border-color: #8f723d; }
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
.error { color: #c0392b; background: #fbeaea; padding: 8px; border-radius:6px; font-size:0.9rem; margin-bottom:10px; }
.success { color: #27ae60; background: #e6f8ed; padding: 8px; border-radius:6px; font-size:0.9rem; margin-bottom:10px; }
.auth-footer { text-align: center; margin-top: 20px; font-size: 0.9rem; color:#333; }
.auth-footer a { color: #8f723d; text-decoration:none; font-weight:bold; }
.auth-footer a:hover { text-decoration:underline; }
</style>
</head>
<body>
<div class="auth-box">
  <h1>PCVerse</h1>
  <h2><i class="fa-solid fa-user-plus"></i> Create Account</h2>

  <?php if ($error_message): ?>
    <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
  <?php endif; ?>
  <?php if ($success_message): ?>
    <div class="success"><?php echo $success_message; ?></div>
  <?php endif; ?>

  <form method="POST" action="register.php">
    <input type="text" name="username" placeholder="Username" required value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
    <input type="email" name="email" placeholder="Email Address" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <button type="submit">Register</button>
  </form>

  <div class="auth-footer">
    <p>Already have an account? <a href="login.php">Log In</a></p>
  </div>
</div>
</body>
</html>
