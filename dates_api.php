<?php
include 'db.php';

header('Content-Type: application/json');

// Get server current time
$currentDate = new DateTime("now", new DateTimeZone("UTC")); // You can set your preferred timezone here

try {
  $stmt = $pdo->query("SELECT key_name, date_value FROM config_dates");
  $dates = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

  // TEST
  /** 
$april18 = new DateTime('2025-03-17 01:00:00', new DateTimeZone("UTC"));
$june13 = new DateTime('2025-03-17 02:00:00', new DateTimeZone("UTC"));
$june22 = new DateTime('2025-03-17 03:59:59', new DateTimeZone("UTC"));
$june23 = new DateTime('2025-03-17 22:00:00', new DateTimeZone("UTC"));
*/


  // FIXED

  $april18 = new DateTime('2025-11-18 15:59:59', new DateTimeZone("UTC"));
  $june13 = new DateTime('2025-11-16 00:00:00', new DateTimeZone("UTC"));
  $june22 = new DateTime('2025-11-22 23:59:59', new DateTimeZone("UTC"));
  $june23 = new DateTime('2025-11-23 00:00:00', new DateTimeZone("UTC"));

  $visibility = [
    'show_form' => false,
    'show_date_before' => false,
    'show_finals' => false,
    'show_date_after' => false,
    'show_results' => false
  ];

  if ($currentDate <= $april18) {
    $visibility['show_form'] = true;
    $visibility['show_date_before'] = true;
  } elseif ($currentDate >= $june13 && $currentDate <= $june22) {
    $visibility['show_finals'] = true;
    $visibility['show_date_after'] = true;
  } elseif ($currentDate >= $june23) {
    $visibility['show_results'] = true;
  }

  echo json_encode($visibility);
} catch (PDOException $e) {
  echo json_encode(['error' => $e->getMessage()]);
}
?>