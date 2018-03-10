<?php
session_start();
//echo session_id();

//$_SESSION["query"] = 1;
include "admin/settings.php";
//$_SESSION["query"] = 0;


if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$setlogout = "UPDATE users SET loggedin=0 WHERE userID='" . $_SESSION["userid"]. "'";
	$logoutresult = mysqli_query($conn, $setlogout);
	mysqli_close($conn);

	//unset($_SESSION["userid"]);
	//$_SESSION["loggedin"] = "no";
	session_unset(); 

// destroy the session 
	session_destroy(); 

	header("Location: login.php");
?>