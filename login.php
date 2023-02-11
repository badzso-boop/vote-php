<?php
  //include_once 'header.php';
?>

<section>
  <h2>Belépés</h2>
  <div class="signup-form-form">
    <form action="includes/login.inc.php" method="post">
      <input type="text" name="fname" placeholder="Felhasználónév...">
      <input type="password" name="jelszo" placeholder="Jelszó...">
      <button type="submit" name="belep">Belépés</button>
    </form>
  </div>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "uresBemenet") {
        echo "<p>Töltsd ki az összes mezőt!</p>";
      }
      else if ($_GET["error"] == "rosszBelepes") {
        echo "<p>Hupsz nem stimmelnek az adatok!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>
