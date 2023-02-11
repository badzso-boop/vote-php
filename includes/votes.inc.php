<?php
session_start();
if (isset($_POST['vote'])) {
    $kerdes = $_POST['kerdes'];
    $valaszok = (isset($_POST['valasz1']) ? $_POST['valasz1'] : "").",".(isset($_POST['valasz2']) ? $_POST['valasz2'] : "").",".(isset($_POST['valasz3']) ? $_POST['valasz3'] : "").",".(isset($_POST['valasz4']) ? $_POST['valasz4'] : "").",".(isset($_POST['valasz5']) ? $_POST['valasz5'] : "");
    $eredmenyek = (isset($_POST['eredmeny1']) ? '0' : '-1').",".(isset($_POST['eredmeny2']) ? '0' : '-1').",".(isset($_POST['eredmeny3']) ? '0' : '-1').",".(isset($_POST['eredmeny4']) ? '0' : '-1').",".(isset($_POST['eredmeny5']) ? '0' : '-1');
    $felhasznalok = "";

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    
    voteFeltoltes($conn, $kerdes, $valaszok, $eredmenyek, $felhasznalok);
} else if (isset($_POST['send'])) {
    $valasztott = (isset($_POST['szavaz']) ? $_POST['szavaz'] : "");
    if ($valasztott == "") {
        header("location: ../index.php?error=uresMezok");
        exit();
    }
    $kerdes = $_POST['kerdes'];

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';
    
    szavazatLeadasa($conn, $valasztott, $_SESSION['fnev'], $kerdes);
} else {
	header("location: ../index.php");
    exit();
}

