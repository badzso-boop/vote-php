<?php

if (isset($_POST["belep"])) {
  $username = $_POST["fname"];
  $pwd = $_POST["jelszo"];

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  if (emptyInputLogin($username, $pwd) === true) {
    header("location: ../index.php?error=uresBemenetBelep");
		exit();
  }
  
  loginUser($conn, $username, $pwd);

} else {
	header("location: ../index.php");
    exit();
}
