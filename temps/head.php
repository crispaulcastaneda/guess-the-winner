<!DOCTYPE html>
<?php
if (isset($_GET['lang'])) {
  /* FOR SINGLE LANG */
  if (
    $_GET['lang'] === null ||
    $_GET['lang'] === "" ||
    $_GET['lang'] === "en-US" ||
    $_GET['lang'] === "en" ||
    $_GET['lang'] === "cn" ||
    $_GET['lang'] === "id" ||
    $_GET['lang'] === "inr" ||
    $_GET['lang'] === "krw" ||
    $_GET['lang'] === "th" ||
    $_GET['lang'] === "vn"
  ) {
    include "./assets/translations/en.php";
  }
  /* FOR SINGLE LANG END*/

  /* FOR MULTIPLE LANG */
  if ($_GET['lang'] === null || $_GET['lang'] === "" || $_GET['lang'] === "en") {
    include "./assets/translations/en.php";
  }
  if ($_GET['lang'] === "cn") {
    include "./assets/translations/cn.php";
  }
  if ($_GET['lang'] === "id") {
    include "./assets/translations/id.php";
  }
  if ($_GET['lang'] === "inr") {
    include "./assets/translations/inr.php";
  }
  if ($_GET['lang'] === "krw") {
    include "./assets/translations/krw.php";
  }
  if ($_GET['lang'] === "th") {
    include "./assets/translations/th.php";
  }
  if ($_GET['lang'] === "vn") {
    include "./assets/translations/vn.php";
  }
  /* FOR MULTIPLE LANG END*/
} else {
  include "./assets/translations/en.php";
}
?>
<html lang="<?php echo $language; ?>">

<head>
  <?php
  $url = $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
  $config = [
    'localhost/index.php' => [
      'ga_code' => 'G-JN7M6KKMXH',
    ],
    'project5.clientbeta.tech/index.php' => [
      'ga_code' => 'G-JN7M6KKMXH',
    ],
  ];
  ?>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $config[$url]['ga_code']; ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', '<?php echo $config[$url]['ga_code']; ?>');
  </script>
  <title><?php echo $title; ?></title>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />

  <link rel="shortcut icon" href="assets/images/favicon-16x16.png" type="image/x-icon">

  <link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/misc.css" />

  <script type="text/javascript" src="assets/js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery-migrate-3.3.2.min.js"></script>
  <script type="text/javascript" src="assets/js/swiper-bundle.min.js"></script>
</head>

<body class="registered">