<section class="tnc">
  <div class="inner">

    <h4 class="tnc__head"><?php echo $tnc2; ?></h4>
    <ol class="tnc__content">
      <?php
      if (isset($_GET['lang'])) {
        if ($_GET['lang'] === null || $_GET['lang'] === "" || $_GET['lang'] === "en") {
          include "./assets/translations/tnc/en-tnc.php";
        }
        if ($_GET['lang'] === "cn") {
          include "./assets/translations/tnc/cn-tnc.php";
        }
        if ($_GET['lang'] === "id") {
          include "./assets/translations/tnc/id-tnc.php";
        }
        if ($_GET['lang'] === "inr") {
          include "./assets/translations/tnc/inr-tnc.php";
        }
        if ($_GET['lang'] === "krw") {
          include "./assets/translations/tnc/krw-tnc.php";
        }
        if ($_GET['lang'] === "th") {
          include "./assets/translations/tnc/th-tnc.php";
        }
        if ($_GET['lang'] === "vn") {
          include "./assets/translations/tnc/vn-tnc.php";
        }
      } else {
        include "./assets/translations/tnc/en-tnc.php";
      }
      ?>
    </ol>

  </div>
</section>