<?
/*
TODO: 

	Inventory
		Cancel Order

	
	
Add Login
	Navbar
	Cookies
	Users table 
	
Sanitize inputs (Security)
*/

include "settings.php";
//VERIFY LOGIN
session_start();

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

    redirect("../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DBA mysql</title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div><table>
	<tr><td><a href="dba.php"> DBA Home </a></td><td><a href="../logout.php"> log out </a></td></tr>
</table></div>

<div id="page-back">
	<h1>MySQL Info</h1>
	<?php 

	$output = shell_exec('/usr/bin/python script/mysqlinfo.py');
	echo $output;


	?>
</div>


</body>
</html> 


<?php 
mysqli_close($conn);
?>