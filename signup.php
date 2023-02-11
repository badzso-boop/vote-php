<?php
  //include_once 'header.php';
?>

<section>
  <h2>Regisztráció</h2>
  <div>
    <form action="includes/signup.inc.php" method="post">
      <input type="text" name="name" placeholder="Teljes név...">
      <input type="text" name="fname" placeholder="Felhasználónév...">
      <input type="text" name="email" placeholder="Email...">
      <input type="password" name="jelszo" placeholder="Jelszó...">
      <input type="password" name="jelszorpt" placeholder="Jelszó újra...">
      <button type="submit" name="reg">Regisztráció</button>
    </form>
  </div>
  
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "uresBemenet") {
        echo "<p>Töltsd ki az összes mezőt!</p>";
      }
      else if ($_GET["error"] == "rosszfname") {
        echo "<p>Használj megfelelő felhasználónevet!</p>";
      }
      else if ($_GET["error"] == "rosszemail") {
        echo "<p>Használj megfelelő email címet!</p>";
      }
      else if ($_GET["error"] == "jelszoNemEgyezik") {
        echo "<p>Jelszavak nem egyeznek!</p>";
      }
      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Hupsz valami hiba történt!</p>";
      }
      else if ($_GET["error"] == "fnameHasznalt") {
        echo "<p>Felhasználónév már foglalat!</p>";
      }
      else if ($_GET["error"] == "none") {
        echo "<p>Gratulálok! Sikeres regisztráció!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>
