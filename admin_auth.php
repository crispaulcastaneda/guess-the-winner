<?php
// admin_auth.php
session_start();

// Check if user is already logged in
function isLoggedIn()
{
  return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Redirect if not logged in

function requireLogin()
{
  if (!isLoggedIn()) {
    header("Location: admin_login.php");
    exit;
  }
}

// Process login
function processLogin($pdo, $username, $password)
{
  try {
    $stmt = $pdo->prepare("SELECT id, username, password FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() === 1) {
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      // Verify password
      if ($password === $user['password']) {
        // Set session
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        return true;
      }
    }
    return false;
  } catch (PDOException $e) {
    return false;
  }
}

// Logout
function logout()
{
  // Unset all session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();

  // Redirect to login page
  header("Location: admin_login.php");
  exit;
}

// If logout is requested
if (isset($_GET['logout'])) {
  logout();
}
?>