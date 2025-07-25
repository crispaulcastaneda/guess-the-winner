<?php
// admin_dates.php
include 'db.php';
include 'admin_auth.php';

// Require login
requireLogin();

// Handle form submission to update dates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_dates'])) {
  try {
    // Update form deadline
    $stmt = $pdo->prepare("UPDATE config_dates SET date_value = ? WHERE key_name = 'form_deadline'");
    $stmt->execute([$_POST['form_deadline']]);

    // Update results date
    $stmt = $pdo->prepare("UPDATE config_dates SET date_value = ? WHERE key_name = 'results_date'");
    $stmt->execute([$_POST['results_date']]);

    $message = "Dates updated successfully!";
  } catch (PDOException $e) {
    $error = "Error updating dates: " . $e->getMessage();
  }
}

// Get current dates
try {
  $stmt = $pdo->query("SELECT key_name, date_value FROM config_dates");
  $dates = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
} catch (PDOException $e) {
  $error = "Error fetching dates: " . $e->getMessage();
  $dates = [];
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin - Manage Dates</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f4f4f4;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
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

    .success {
      color: green;
      margin-bottom: 15px;
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

    .logout {
      float: right;
    }
  </style>
</head>

<body>
  <div class="container">
    <a href="admin_dates.php?logout=1" class="logout">Logout</a>
    <h1>Manage Important Dates</h1>

    <?php if (isset($message)): ?>
      <div class="success"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="form-group">
        <label>Form Submission Deadline:</label>
        <input type="datetime-local" name="form_deadline"
          value="<?php echo isset($dates['form_deadline']) ? date('Y-m-d\TH:i', strtotime($dates['form_deadline'])) : ''; ?>">
      </div>
      <div class="form-group">
        <label>Results Display Date:</label>
        <input type="datetime-local" name="results_date"
          value="<?php echo isset($dates['results_date']) ? date('Y-m-d\TH:i', strtotime($dates['results_date'])) : ''; ?>">
      </div>
      <div>
        <button type="submit" name="update_dates" class="submit-btn">Update Dates</button>
      </div>
    </form>
  </div>
</body>

</html>