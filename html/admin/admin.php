
<?php

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
  <title>Hayden Redford</title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div><table>
	<tr><td><a href="admin.php"> Admin Home </a></td><td><a href="../logout.php"> log out </a></td></tr>
</table></div>
<div id = "page-back">
	<h3>Manage Games</h3>
	<form action="viewgames.php" method="post">
	<input type="submit" id="submitaddgame"/>
	</form>
</div>



<div id="page-back">
	<h3>Manage Employees</h3>
	<form action="viewemployees.php" method="post">
	<select name="warehouse">
	<?php
	$sql = "SELECT name FROM warehouse";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<option value=\"" . $row['name'] . "\">" . $row['name'] . "</option>";
	}
	?>
	</select>
	<input type="submit" id="submitemployeelookup"/>
	</form>
</div>



<div id = "page-back">
	<h3>Manage Customers Orders and Info</h3>
	<form action="custlookup.php" method="post">
	<table>
	<tr><td>Firstname:</td> <td><input type="text" name="firstname" /></td></tr>
	<tr><td>Lastname: </td><td><input type="text" name="lastname" /></td></tr>
	</table>
	<input type="submit" id="submitcustlookup"/>
	</form>
	<br>Hint: try 'Tessy Tester'
</div>


<div id = "page-back">
	<h3>Manage Reviews</h3>
	<form action="reviewlookup.php" method="post">
	<select name="reviewgame">
	<?php
	$sql = "SELECT name FROM game";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<option value=\"" . $row['name'] . "\">" . $row['name'] . "</option>";
	}
	?>
	</select>
	<input type="submit" id="submitreviewlookup"/>
	</form>
</div>


<div id = "page-back">
	<h3>Manage Shipments</h3>
	<form action="warehouselookup.php" method="post">
	<select name="wid">
	<?php
	$sql = "SELECT name, warehouseID FROM warehouse";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<option value=\"" . $row['warehouseID'] . "\">" . $row['name'] . "</option>";
	}
	?>
	</select>
	<input type="submit" id="submitwarehouse"/>
	</form>
</div>

<div id = "page-back">
	<h3>Manage Inventory</h3>
	<form action="inventorylookup.php" method="post">
	<select name="wid">
	<?php
	$sql = "SELECT name, warehouseID FROM warehouse";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<option value=\"" . $row['warehouseID'] . "\">" . $row['name'] . "</option>";
	}
	?>
	</select>
	<input type="submit" id="submitinventory"/>
	</form>
</div>



</body>
</html> 

<?php 
mysqli_close($conn);
?>