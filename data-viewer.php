<?php
require_once 'db.php';

// SINCE I HAVE 3 TABLE
// ONLY SPECIFIC TABLE SHOULD BE CALL
$allowedTables = ['team_selection_nba_table']; // Add other allowed tables here if needed
$specificTable = "team_selection_nba_table";

// VALIDATION OF TABLE SECURITY
if (!in_array($specificTable, $allowedTables)) {
  die("Invalid table selection.");
}

// CUSTOM HEADERS FOR USER-FRIENDLY EXPORT
$customHeaders = [
  'id' => 'ID',
  'username' => 'Username',
  'team1' => 'Western Conference',
  'team2' => 'Eastern Conference',
  'selected_team' => 'Final Winner',
  'created_at' => 'Registration Date',
  'selected_lang' => 'Registration Market',
];

// FUNCTION OF EXPORTING TO CSV WITH IMPROVED SECURITY
function exportCSV($data, $filename = 'export.csv')
{
  // SANITIZATION OF FILENAME PREVENTION OF INJECTION
  $filename = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $filename);

  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="' . $filename . '"');
  header('Pragma: no-cache');
  header('Expires: 0');

  $output = fopen('php://output', 'w');

  // IF ONLY HAS DATA -> THROW TO HEADERS
  if (!empty($data)) {
    $dbColumns = array_keys($data[0]);

    // CUSTOM HEADER ROW HOLDER
    $headerRow = [];
    foreach ($dbColumns as $column) {
      if (isset($customHeaders[$column])) {
        $headerRow[] = $customHeaders[$column];
      } else {
        $headerRow[] = $column;
      }
    }

    fputcsv($output, $headerRow);

    // ROW DATA -> data / data / data / data ...
    foreach ($data as $row) {
      // PREVENT FORMULA EXECUTION IN CSV FILE
      $cleanRow = array_map(function ($value) {
        // PREFIX FOR THE USERS TO PREVENT FORMULA INJECTIONS - BAWAL HACKER DITO ADIK KA BA.
        if (is_string($value) && in_array(substr($value, 0, 1), ['=', '+', '-', '@'])) {
          $value = "'" . $value;
        }
        return $value;
      }, $row);

      fputcsv($output, $cleanRow);
    }
  }

  fclose($output);
  exit;
}

// EXPORT ACTION
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
  try {
    $stmt = $pdo->prepare("SELECT * FROM `" . $specificTable . "`");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    exportCSV($data, $specificTable . '_export.csv');
  } catch (PDOException $e) {
    // Log error to server logs but don't expose details to user
    error_log("CSV Export error: " . $e->getMessage());
    die("Export failed. Please try again later.");
  }
}

// PAGINATION SETTINGS
$recordsPerPage = isset($_GET['recordsPerPage']) && is_numeric($_GET['recordsPerPage']) ?
  (int) $_GET['recordsPerPage'] : 10; // Default 10 records per page
// Validate records per page to allowed values only
$allowedPerPage = [10, 25, 50, 100];
if (!in_array($recordsPerPage, $allowedPerPage)) {
  $recordsPerPage = 10; // Default if invalid value
}

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max(1, $page); // Ensure page is at least 1

// Get total records count
try {
  $countStmt = $pdo->prepare("SELECT COUNT(*) FROM `" . $specificTable . "`");
  $countStmt->execute();
  $totalRecords = $countStmt->fetchColumn();
} catch (PDOException $e) {
  error_log("Count error: " . $e->getMessage());
  $totalRecords = 0;
}

// Calculate total pages
$totalPages = ceil($totalRecords / $recordsPerPage);
$page = min($page, max(1, $totalPages)); // Ensure page doesn't exceed total pages

// Calculate the offset for the query
$offset = ($page - 1) * $recordsPerPage;

// TABLE DATA HOLDER
$tableData = [];
$columns = [];

try {
  // GET DATA - Using backticks for table names and LIMIT with OFFSET for pagination
  $stmt = $pdo->prepare("SELECT * FROM `" . $specificTable . "` LIMIT :limit OFFSET :offset");
  $stmt->bindParam(':limit', $recordsPerPage, PDO::PARAM_INT);
  $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
  $stmt->execute();
  $tableData = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // GET COL
  if (!empty($tableData)) {
    $columns = array_keys($tableData[0]);
  } else {
    // GET COL IF NO DATA THROW HEADER
    $columnsQuery = $pdo->query("SHOW COLUMNS FROM `" . $specificTable . "`");
    $columns = $columnsQuery->fetchAll(PDO::FETCH_COLUMN);
  }
} catch (PDOException $e) {
  // THROW CONSOLE ERROR
  error_log("Database error: " . $e->getMessage());
  $error = "Error fetching data. Please try again later.";
}

// SAFE OUTPUT DATA AND XSS PREVENTION
function safeOutput($value)
{
  if (is_null($value)) {
    return '<em>NULL</em>';
  } elseif ($value === '') {
    return '<em>Empty</em>';
  } else {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }
}

// Function to generate pagination links
function generatePaginationLinks($currentPage, $totalPages, $recordsPerPage)
{
  $links = '';

  // Previous page link
  if ($currentPage > 1) {
    $links .= '<a href="?page=' . ($currentPage - 1) . '&recordsPerPage=' . $recordsPerPage . '" class="page-link">&laquo; Previous</a>';
  } else {
    $links .= '<span class="page-link disabled">&laquo; Previous</span>';
  }

  // Page numbers
  $startPage = max(1, $currentPage - 2);
  $endPage = min($totalPages, $currentPage + 2);

  // Always show first page
  if ($startPage > 1) {
    $links .= '<a href="?page=1&recordsPerPage=' . $recordsPerPage . '" class="page-link">1</a>';
    if ($startPage > 2) {
      $links .= '<span class="ellipsis">...</span>';
    }
  }

  // Page numbers
  for ($i = $startPage; $i <= $endPage; $i++) {
    if ($i == $currentPage) {
      $links .= '<span class="page-link current">' . $i . '</span>';
    } else {
      $links .= '<a href="?page=' . $i . '&recordsPerPage=' . $recordsPerPage . '" class="page-link">' . $i . '</a>';
    }
  }

  // Always show last page
  if ($endPage < $totalPages) {
    if ($endPage < $totalPages - 1) {
      $links .= '<span class="ellipsis">...</span>';
    }
    $links .= '<a href="?page=' . $totalPages . '&recordsPerPage=' . $recordsPerPage . '" class="page-link">' . $totalPages . '</a>';
  }

  // Next page link
  if ($currentPage < $totalPages) {
    $links .= '<a href="?page=' . ($currentPage + 1) . '&recordsPerPage=' . $recordsPerPage . '" class="page-link">Next &raquo;</a>';
  } else {
    $links .= '<span class="page-link disabled">Next &raquo;</span>';
  }

  return $links;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Security-Policy"
    content="default-src 'self'; style-src 'self' 'unsafe-inline'; script-src 'self';">
  <title>NBA ADMIN - Database Viewer</title>
  <style>
    body {
      font-family: 'Lato', sans-serif;
      margin: 20px;
      color: #222939;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
    }

    .actions {
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th,
    td {
      border: 1px solid #D3D4D7;
      padding: 22px 12px;
      text-align: left;
      word-break: break-word;
      max-width: 300px;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    th {
      background-color: #E9EAEB;
      position: sticky;
      top: 0;
    }

    tr:nth-child(even) {
      background-color: #F4F4F5;
    }

    .btn {
      display: inline-block;
      padding: 12px 16px;
      background-color: #329C69;
      color: #FFFFFF;
      text-decoration: none;
      border-radius: 4px;
      transition: all .3s ease-in-out;
    }

    .btn:hover {
      background-color: #E4F3EA;
      color: #4E5461;
    }

    .error {
      color: red;
      padding: 10px;
      background-color: #ffecec;
      border: 1px solid #f5aca6;
      margin-bottom: 20px;
    }

    em {
      color: #D3D4D7;
      font-style: italic;
    }

    /* Pagination Styles */
    .pagination {
      display: flex;
      justify-content: center;
      margin: 20px 0;
      flex-wrap: wrap;
    }

    .page-link {
      display: inline-block;
      padding: 8px 12px;
      margin: 0 4px;
      border: 1px solid #D3D4D7;
      color: #329C69;
      text-decoration: none;
      border-radius: 4px;
    }

    .page-link:hover {
      background-color: #E4F3EA;
    }

    .page-link.current {
      background-color: #329C69;
      color: white;
      border-color: #329C69;
    }

    .page-link.disabled {
      color: #D3D4D7;
      pointer-events: none;
    }

    .ellipsis {
      padding: 8px 12px;
      margin: 0 4px;
    }

    .page-info {
      text-align: center;
      margin-bottom: 10px;
      color: #4E5461;
    }

    /* Records per page dropdown styles */
    .records-select {
      padding: 6px 10px;
      border-radius: 4px;
      border: 1px solid #D3D4D7;
      background-color: white;
      cursor: pointer;
    }

    .records-select:focus {
      outline: none;
      border-color: #329C69;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>NBA ADMIN: Table Viewer</h1>

    <?php if (isset($error)): ?>
      <div class="error"><?php echo ($error); ?></div>
    <?php endif; ?>

    <div class="actions">
      <a href="?export=csv" class="btn">Export to CSV</a>
      <div>
        <form method="GET" action="" id="perPageForm">
          <label for="recordsPerPage">Records per page:</label>
          <select name="recordsPerPage" id="recordsPerPage" class="records-select">
            <option value="10" <?php echo $recordsPerPage == 10 ? 'selected' : ''; ?>>10</option>
            <option value="25" <?php echo $recordsPerPage == 25 ? 'selected' : ''; ?>>25</option>
            <option value="50" <?php echo $recordsPerPage == 50 ? 'selected' : ''; ?>>50</option>
            <option value="100" <?php echo $recordsPerPage == 100 ? 'selected' : ''; ?>>100</option>
          </select>
          <?php if (isset($_GET['page'])): ?>
            <input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
          <?php endif; ?>
        </form>
      </div>
    </div>

    <?php if (!empty($tableData)): ?>
      <div class="page-info">
        Showing <?php echo ($offset + 1); ?>-<?php echo min($offset + $recordsPerPage, $totalRecords); ?> of
        <?php echo $totalRecords; ?> records
      </div>

      <table>
        <thead>
          <tr>
            <?php foreach ($columns as $column): ?>
              <th>
                <?php
                if (isset($customHeaders[$column])) {
                  echo htmlspecialchars($customHeaders[$column], ENT_QUOTES, 'UTF-8');
                } else {
                  echo htmlspecialchars($column, ENT_QUOTES, 'UTF-8');
                }
                ?>
              </th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tableData as $row): ?>
            <tr>
              <?php foreach ($row as $value): ?>
                <td><?php echo safeOutput($value); ?></td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="pagination">
        <?php echo generatePaginationLinks($page, $totalPages, $recordsPerPage); ?>
      </div>
    <?php else: ?>
      <p>No data found in table: <?php echo ($specificTable); ?></p>
    <?php endif; ?>

    <div>
      <p>Total records: <?php echo $totalRecords; ?></p>
      <p><small>Last updated: <?php echo date('Y-m-d H:i:s'); ?></small></p>
    </div>
  </div>

  <script src="assets/js/data-viewer.js"></script>
</body>

</html>