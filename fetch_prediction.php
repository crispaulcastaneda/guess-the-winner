<?php
// Save as fetch_prediction.php
header('Content-Type: application/json');

// $host = 'localhost';
// $dbname = 'team_selection_nba';
// $username = 'root';
// $password = '';

$host = 'localhost';
$dbname = 'u272364034_nba_team';
$username = 'u272364034_ilpnbateam';
$password = 'Hostinger2021!!';

//  $host = 'localhost';
// $dbname = 'team_selection_nba';
//  $username = 'm88festival-user';
//  $password = 'm88festival2025';


try {

  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $selected_lang = $_POST['selected_lang'] ?? 'en';

    $languageFile = 'assets/translations/en.php'; // Default language
    if ($selected_lang === 'id') {
      $languageFile = 'assets/translations/id.php'; // Indonesian language
    }

    include $languageFile;


    if (empty($username)) {
      echo json_encode(["status" => "error", "message" => $usernamerequired]);
      exit;
    }

    // Check the actual column names in your database table
    // This query will show you the column names
    $columns = $pdo->query("SHOW COLUMNS FROM team_selection_nba_table")->fetchAll(PDO::FETCH_COLUMN);

    // Use the correct column names from your database
    $stmt = $pdo->prepare("SELECT team1, team2, selected_team FROM team_selection_nba_table WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
      echo json_encode([
        "status" => "success",
        "team1" => $result['team1'],
        "team2" => $result['team2'],
        "selected_team" => $result['selected_team']
      ]);
    } else {
      echo json_encode(["status" => "error", "message" => $nopredictionuser]);
    }
  }
} catch (PDOException $e) {
  echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>