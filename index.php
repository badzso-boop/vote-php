<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script src="js/index.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">SzavazzON</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php 
                    if (isset($_SESSION['fnev'])) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="logout.php">Kilépés</a>
                            </li>';
                    } else {
                        echo '<li class="nav-item">
                            <a class="nav-link" href="index.php">Regisztráció</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Belépés</a>
                        </li>';
                    }
                ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php 
            if (isset($_SESSION['fnev'])) {
                echo '<h2 class="text-center">Üdvözlöm kedves '.$_SESSION['fnev'].'!</h2>';
            }
            else {
                echo '<h2 class="text-center">Kérem lépjen be!</h2>';
            }
        ?>
        
        <div class="row">
            <div class="col">
                <section>
                    <h2>Regisztráció</h2>
                    <div>
                        <form action="includes/signup.inc.php" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Teljes név</label>
                                <input type="text" name="name" class="form-control" placeholder="Teljes név">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Felhasználónév</label>
                                <input type="text" name="fname" class="form-control" placeholder="Felhasználónév">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email cím</label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                <small id="emailHelp" class="form-text text-muted">Az adatai biztonságban vannak nálunk!</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Jelszó</label>
                                <input type="password" name="jelszo" class="form-control" placeholder="Jelszó">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Jelszó újra</label>
                                <input type="password" name="jelszorpt" class="form-control" placeholder="Jelszó újra">
                            </div>
                            <button type="submit" class="btn btn-primary" name="reg">Regisztráció</button>
                        </form>
                    </div>
                    
                    <?php
                        // Error messages
                        if (isset($_GET["error"])) {
                        if ($_GET["error"] == "uresBemenet") {
                            echo '<div class="alert alert-danger m-3" role="alert">Töltsd ki az összes mezőt!</div>';
                        }
                        else if ($_GET["error"] == "rosszfname") {
                            echo '<div class="alert alert-danger m-3" role="alert">Használj megfelelő felhasználónevet!</div>';
                        }
                        else if ($_GET["error"] == "rosszemail") {
                            echo '<div class="alert alert-danger m-3" role="alert">Használj megfelelő email címet!</div>';
                        }
                        else if ($_GET["error"] == "jelszoNemEgyezik") {
                            echo '<div class="alert alert-danger m-3" role="alert">Jelszavak nem egyeznek!</div>';
                        }
                        else if ($_GET["error"] == "stmtfailed") {
                            echo '<div class="alert alert-danger m-3" role="alert">Hupsz valami hiba történt!</div>';
                        }
                        else if ($_GET["error"] == "fnameHasznalt") {
                            echo '<div class="alert alert-danger m-3" role="alert">Felhasználónév már foglalat!</div>';
                        }
                        else if ($_GET["error"] == "noneReg") {
                            echo '<div class="alert alert-success m-3" role="alert">Gratulálok! Sikeres regisztráció!</div>';
                        }
                        }
                    ?>
                </section>
            </div>
            <div class="col">
                <section>
                    <h2>Belépés</h2>
                    <div class="signup-form-form">
                        <form action="includes/login.inc.php" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Teljes név</label>
                                <input type="text" name="fname" class="form-control" placeholder="Felhasználónév">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jelszó</label>
                                <input type="password" name="jelszo" class="form-control" placeholder="Jelszó">
                            </div>
                            <button type="submit" class="btn btn-primary" name="belep">Belépés</button>
                        </form>
                    </div>
                    <?php
                        // Error messages
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "uresBemenetBelep") {
                                echo '<div class="alert alert-danger m-3" role="alert">Töltsd ki az összes mezőt!</div>';
                            }
                            else if ($_GET["error"] == "rosszBelepesBelep") {
                                echo '<div class="alert alert-danger m-3" role="alert">Hupsz nem stimmelnek az adatok!</div>';
                            }
                            else if ($_GET["error"] == "noneBelepes") {
                                echo '<div class="alert alert-success m-3" role="alert">Gratulálok! Sikeres belépés!</div>';
                            }
                        }
                    ?>
                </section>
            </div>
        </div>
    </div>

    <br>

    <?php 
        if (isset($_SESSION['fnev'])) {
            if ($_SESSION['fnev'] == 'norbi') {
                echo '<h1 class="text-center">Szavazásra bocsájtás</h1>

                <form action="includes/votes.inc.php" method="post" id="kerdesForm" class="text-center w-50 m-auto">
                    <div class="form-group">
                        <label>Kérdés</label>
                        <input type="text" class="form-control" name="kerdes" placeholder="Kérdés">
                    </div>
                    <div class="form-group">
                        <label>Kérdések száma</label>
                        <input min="2" max="5" type="number" class="form-control" id="valaszokSzama" onchange="valaszok()" placeholder="Kérdések száma">
                    </div>
                    <div id="valaszok"></div>
                    <div id="eredmenyek"></div>
                    <button class="btn btn-primary m-3" type="submit" name="vote">Feltöltés</button>
                </form>';
            }
        }
    ?>

    <br>

    <h1 class="text-center">Szavazni valók</h1>
    
    <div class="container">
        <?php
            if (isset($_GET['error'])) {
                if ($_GET["error"] == "uresMezok") {
                    echo "<p>Töltsd ki az összes mezőt!</p>";
                }
            }

            require_once 'includes/dbh.inc.php';
            require_once 'includes/functions.inc.php';

            $votes = kerdoivekLekeres($conn);

            if ($votes->num_rows > 0) {
                while($seged = $votes->fetch_assoc()) {
                    $valaszok = explode(",", $seged["valaszok"]);
                    $eredmenyek = explode(",", $seged["eredmenyek"]);
                    $felhasznalok = explode(",", $seged["felhasznalok"]);
                    $szam = count($valaszok);

                    echo '
                    <div class="card d-inline-block m-4" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">'.$seged['kerdes'].'</h5>
                            <hr>
                            <div class="card-text">
                                <form class="m-2"" action="includes/votes.inc.php" method="post">
                                <input type="text" name="kerdes" value="'.$seged['kerdes'].'" class="hide">';            
                                for ($i=0; $i < $szam; $i++) {
                                    if ($valaszok[$i] == "") {
                                        echo '<br><br>';
                                    } else {
                                        echo '<input type="radio" name="szavaz" value="'.$i.'">
                                        <label for="szavaz">'.$valaszok[$i].' ('.$eredmenyek[$i].')</label><br>';
                                        echo '<div class="progress w-75">
                                            <div class="progress-bar" role="progressbar" style="width: '.$eredmenyek[$i].'%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>';
                                    }
                                }

                                if (isset($_SESSION['fnev'])) {
                                    echo '<button class="btn btn-primary mt-2" name="send" type="submit">Kitöltés</button></form><button class="btn btn-primary m-2" onClick="mutat('.$seged['id'].')">Felhasználók mutat</button><br>';
                                }

                                if(count($felhasznalok) > 1) {
                                    echo '<button class="btn btn-primary m-2" type="button" data-toggle="collapse" data-target="#collapseExample'.$seged['id'].'" aria-expanded="false" aria-controls="collapseExample">
                                                Szavazott felhasználók
                                            </button>';

                                    echo '<div class="collapse m-2 m-auto" id="collapseExample'.$seged['id'].'">
                                        <div class="card card-body">';
                                    echo '<ol>';
                                    for ($i=0; $i < count($felhasznalok); $i++) {
                                        echo '<li>'.$felhasznalok[$i].'</li>';
                                    }
                                    echo '</ol>';
                                }
                                    echo '</div>
                                    </div>';
                                echo '</div>
                        </div>
                    </div>';
                }
            }
        ?>
    </div>


    <footer class="bg-dark text-center text-white">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Copyright:
            <a class="text-white" href="https://www.instagram.com/ujj_norbert/">Ujj Norbert</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>
</html>