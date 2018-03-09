<?php

/*
TODO: 
Warehouse
	Add warehouse
	See Merch Orders
		Cancel order
	See Recieving
		Verify recieved
	See Shipping
		Verify fulfillment
		Cancel Order
See Reviews
	Remove review

Add Login
	Navbar
	Cookies
	Users table 
	
Sanitize inputs (Security)
*/

include "admin/settings.php";
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


<div id = "page-back">
	<h3>Lookup Games</h3>
	<form action="admin/viewgames.php" method="post">
	<input type="submit" id="submitaddgame"/>
	</form>
</div>



<div id="page-back">
	<h3>Lookup Employees</h3>
	<form action="admin/viewemployees.php">
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
	<h3>Lookup Customer and Orders</h3>
	<form action="admin/custlookup.php" method="post">
	<table>
	<tr><td>Firstname:</td> <td><input type="text" name="firstname" /></td></tr>
	<tr><td>Lastname: </td><td><input type="text" name="lastname" /></td></tr>
	</table>
	<input type="submit" id="submitcustlookup"/>
	</form>
	<br>Hint: try Tessy Tester
</div>


<div id = "page-back">
	<h3>Lookup Reviews</h3>
	<form action="admin/reviewlookup.php">
	<select>
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
	<h3>Lookup Warehouse</h3>
	<form action="admin/viewinventory.php">
	<select name="games">
	<?php
	$sql = "SELECT name FROM warehouse";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<option value=\"" . $row['name'] . "\">" . $row['name'] . "</option>";
	}
	?>
	</select>
	<input type="submit" id="submitinventory"/>
	</form>
</div>


<div id = "page-back">
	<h3>Add New Warehouse</h3>
	<form action="admin/addwarehousequery.php" method="post">
	<table>
	<tr><td>name:</td> <td><input type="text" name="name" /></td></tr>
	<tr><td>address: </td><td><input type="text" name="address" /></td></tr>
	<tr><td>city:</td><td> <input type="text" name="text" /></td></tr>
	<tr><td>state:</td><td> <input type="text" name="state" /></td></tr>
	<tr><td>zip: </td><td><input type="number" name="zip" /></td></tr>
	<tr><td>manager first name: </td><td><input type="text" name="mfirst" /></td></tr>
	<tr><td>manager last name: </td><td><input type="text" name="mlast" /></td></tr>
	</table>
	<input type="submit" id="submitaddwarehouse"/>
	</form>

</div>


</body>
</html> 

<?php 
mysqli_close($conn);
?>