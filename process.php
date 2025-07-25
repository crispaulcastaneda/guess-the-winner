<?php
include 'db.php';
header("Content-Type: application/json");

// First, check if the submission period is still open
try {
  $stmt = $pdo->query("SELECT date_value FROM config_dates WHERE key_name = 'form_deadline'");
  $deadline = $stmt->fetchColumn();

  $current_time = date('Y-m-d H:i:s'); // Server time

  if ($current_time > $deadline) {
    // Form submission period has ended
    echo json_encode(["status" => "error", "message" => "The prediction period has ended."]);
    exit;
  }
} catch (PDOException $e) {
  // Handle database error
  echo json_encode(["status" => "error", "message" => "System error. Please try again later."]);
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Your existing code starts here
  // Sanitize input
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $team1 = filter_input(INPUT_POST, 'team1', FILTER_SANITIZE_STRING);
  $team2 = filter_input(INPUT_POST, 'team2', FILTER_SANITIZE_STRING);
  $selected_team = filter_input(INPUT_POST, 'selected_team', FILTER_SANITIZE_STRING);
  $selected_lang = filter_input(INPUT_POST, 'selected_lang', FILTER_SANITIZE_STRING);

  $languageFile = 'assets/translations/en.php'; // Default language
  if ($selected_lang === 'id') {
    $languageFile = 'assets/translations/id.php'; // Indonesian language
  }

  include $languageFile;

  if (!$username || !$team1 || !$team2 || !$selected_team || !$selected_lang) {
    echo json_encode(["status" => "error", "message" => $errorFill]);
    exit;
  }

  try {
    // Check if username already made a selection
    $stmt = $pdo->prepare("SELECT * FROM team_selection_nba_table WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
      echo json_encode(["status" => "error", "message" => $alreadySelected]);
      exit;
    }

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO team_selection_nba_table (username, team1, team2, selected_team, selected_lang) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$username, $team1, $team2, $selected_team, $selected_lang]);

    // Write to CSV file
    $file = 'csv/selections.csv';
    $data = [$username, $team1, $team2, $selected_team, $selected_lang, date('Y-m-d H:i:s')];

    if (($csv = fopen($file, 'a')) !== false) {
      fputcsv($csv, $data);
      fclose($csv);
      echo json_encode(["status" => "success", "message" => $predictionsuccess]);
    } else {
      echo json_encode(["status" => "error", "message" => "Could not write to CSV file."]);
    }
  } catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
  }
}
?>