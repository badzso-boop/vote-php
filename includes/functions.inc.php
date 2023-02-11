<?php
/*--------------------Regisztráció---------------------*/
#region
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
	$result;
	if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function invalidUid($username) {
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function pwdMatch($pwd, $pwdrepeat) {
	$result;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function uidExists($conn, $username) {
  $sql = "SELECT * FROM felhasznalok WHERE fnev = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../index.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd) {
  $sql = "INSERT INTO felhasznalok (name, fnev, jelszo, email) VALUES (?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../index.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $hashedPwd, $email);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../index.php?error=noneReg");
	exit();
}
#endregion

/*----------------------Belépés----------------*/

#region
function emptyInputLogin($username, $pwd) {
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}


function loginUser($conn, $username, $pwd) {
	$uidExists = uidExists($conn, $username);

	if ($uidExists === false) {
		header("location: ../index.php?error=rosszBelepesBelep");
		exit();
	}

	$pwdHashed = $uidExists["jelszo"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../index.php?error=rosszBelepes");
		exit();
	}
	elseif ($checkPwd === true) {
		session_start();
		$_SESSION["id"] = $uidExists["id"];
		$_SESSION["fnev"] = $uidExists["fnev"];
		header("location: ../index.php?error=noneBelepes");
		exit();
	}
}
#endregion

/*-----------------------Kerdesek--------------*/

#region
function voteFeltoltes($conn, $kerdes, $valaszok, $eredmenyek, $felhasznalok) {
	$sql = "INSERT INTO votes (kerdes, valaszok, eredmenyek, felhasznalok) VALUES (?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../index.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ssss", $kerdes, $valaszok, $eredmenyek, $felhasznalok);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../index.php?error=none");
	exit();
}

function szavazatLeadasa($conn, $valasztott, $uname, $kerdes) {
	$sql = "SELECT * FROM votes WHERE kerdes = ?;";
	$eredmeny;

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../index.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $kerdes);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		$eredmeny = $row;
	}

	mysqli_stmt_close($stmt);

	$dbEredmeny = explode(",", $eredmeny['eredmenyek']);
	$dbEredmeny[$valasztott]++;
	$stringEredmeny = implode(",", $dbEredmeny);

	if ($eredmeny['felhasznalok'] != "") {
		$dbEredmenyUser = explode(",", $eredmeny['felhasznalok']);
		array_push($dbEredmenyUser, $uname);
		$stringEredmenyUser = implode(",", $dbEredmenyUser);
	} else {
		$stringEredmenyUser = $uname;
	}
	

	$sql = "UPDATE votes SET eredmenyek = ?, felhasznalok = ? WHERE id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../index.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "sss", $stringEredmeny, $stringEredmenyUser, $eredmeny['id']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../index.php?error=none");
	exit();
}

function kerdoivekLekeres($conn) {
    $sql = "SELECT * FROM votes";
	$result = $conn->query($sql);

	return $result;
}
#endregion