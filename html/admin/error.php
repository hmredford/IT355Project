<div><table>
	<tr><td><a href="admin.php"> Admin Home </a></td><td><a href="../logout.php"> log out </a></td></tr>
</table></div>
<?php
session_start();
//echo session_id();

if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

	header("Location: ../login.php");
}
//POST variable
?>

<h1>Oops! <br> looks like you didn't fill out the form correctly.</h1>
	<h3><a href="admin.php"> Click Here </a> to be redirected back to the admin page.</h3>