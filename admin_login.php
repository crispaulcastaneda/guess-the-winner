<?php
// admin_login.php
include 'db.php';
include 'admin_auth.php';

// Check if already logged in
if (isLoggedIn()) {
  header("Location: admin_dates.php");
  exit;
}

$error = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  if (empty($username) || empty($password)) {
    $error = "Username and password are required";
  } else {
    if (processLogin($pdo, $username, $password)) {
      header("Location: admin_dates.php");
      exit;
    } else {
      $error = "Invalid username or password";
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .login-container {
      width: 300px;
      margin: 100px auto;
      background: white;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }

    .error {
      color: red;
      margin-bottom: 15px;
    }

    .submit-btn {
      background: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Admin Login</h2>

    <?php if ($error): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit" class="submit-btn">Login</button>
    </form>
  </div>
</body>

</html>