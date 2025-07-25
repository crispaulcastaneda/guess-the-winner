<?php
// $host = 'localhost';
// $dbname = 'team_selection_nba';
// $username = 'root';
// $password = '';

$host = 'localhost';
$dbname = 'u272364034_nba_team';
$username = 'u272364034_ilpnbateam';
$password = 'Hostinger2021!!';


//  $host = 'localhost';
//  $dbname = 'team_selection_nba';
//  $username = 'm88festival-user';
//  $password = 'm88festival2025';

try {
  // $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_general_ci"
  ]);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
?>