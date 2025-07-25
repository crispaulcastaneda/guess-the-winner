<?php

include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

  if (!$username) {
    echo "invalid";
    exit;
  }

  $stmt = $pdo->prepare("SELECT username FROM team_selection_nba_table WHERE username = ?");
  $stmt->execute([$username]);

  if ($stmt->rowCount() > 0) {
    echo "exists";
  } else {
    echo "available";
  }
}

?>