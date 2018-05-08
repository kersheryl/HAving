<?php

session_start(); 

$con = mysqli_connect("localhost", "root", "") or die("Unable to connect");
mysqli_select_db($con, "samplelogindb");

function loggedin() {
	if (isset($_SESSION['email']) || isset($_COOKIE['email'])) {
		$loggedin = TRUE;
		return $loggedin;
	}
}

?>
