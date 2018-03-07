<?php
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
	<h3>View Games</h3>
	<form action="admin/viewgamesquery.php" method="post">
	<input type="submit" id="submitaddgame"/>
	</form>
</div>

<div id = "page-back">
	<h3>Add New Game</h3>
	<form action="admin/addgamequery.php" method="post">
	<table>
	<tr><td>game name:</td> <td><input type="text" name="name" /></td></tr>
	<tr><td>game publisher: </td><td><input type="text" name="publisher" /></td></tr>
	<tr><td>game collection:</td><td> <input type="text" name="collection" /></td></tr>
	<tr><td>release date:</td><td> <input type="date" name="releasedate"></td></tr>
	<tr><td>number of Players:</td><td> <input type="number" name="numplayers" /></td></tr>
	<tr><td>Playtime: </td><td><input type="number" name="playtime" /></td></tr>
	<tr><td>age rating: </td><td><input type="text" name="agerating" /></td></tr>
	<tr><td>description:</td><td> <input type="textarea" name="description"/></td></tr>
	<tr><td>image path:</td><td> <input type="text" name="imagepath" /></td></tr>
	<tr><td>game themes:</td><td> <input type="text" name="themes" /></td></tr>
	<tr><td>game designer: </td><td><input type="text" name="designer" /></td></tr>
	<tr><td>game mechanics:</td><td> <input type="text" name="mechanics" /></td></tr>
	</table>
	<input type="submit" id="submitaddgame"/>
	</form>
</div>

<div id="page-back">
	<h3>View Employees</h3>
	<form action="admin/viewemployeesquery.php">
	<select>
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


<div id="page-back">
	<h3>Game Info</h3>
	<form action="admin/viewgameinfo.php">
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
	<input type="submit" id="submitgameinfo"/>
	</form>
</div>



<div id = "page-back">
	<h3>Lookup Customer</h3>
	<form action="admin/custlookupquery.php" method="post">
	<table>
	<tr><td>Firstname:</td> <td><input type="text" name="fistname" /></td></tr>
	<tr><td>Lastname: </td><td><input type="text" name="lastname" /></td></tr>
	</table>
	<input type="submit" id="submitcustlookup"/>
	</form>
</div>


<div id = "page-back">
	<h3>Lookup Review</h3>
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
	<h3>Delete Review</h3>
	<form action="admin/removereview.php" method="post">
	<table>
	<tr><td>ReviewID:</td> <td><input type="text" name="reviewID" /></td></tr>
	<tr><td>CustomerID: </td><td><input type="text" name="customerID" /></td></tr>
	</table>
	<input type="submit" id="submitremovereview"/>
	</form>
</div>


<div id = "page-back">
	<h3>Lookup Inventory</h3>
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

<div id = "page-back">
	<h3>Lookup Customer Order</h3>
	<form action="admin/custorderlookup.php" method="post">
	<table>
	<tr><td>Firstname:</td> <td><input type="text" name="fistname" /></td></tr>
	<tr><td>Lastname: </td><td><input type="text" name="lastname" /></td></tr>
	</table>
	<input type="submit" id="submitcustorderlookup"/>
	</form>
</div>


</body>
</html> 
