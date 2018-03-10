<div><table>
	<tr><td><a href="admin.php"> Admin Home </a></td><td><a href="../logout.php"> log out </a></td></tr>
</table></div>
<?php
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

//VERIFY INPUTS

if(!isset($_POST["selection"]) ||
!isset($_POST["firstname"]) || 
!isset($_POST["lastname"])||
!isset($_POST["changeText"]))
{
    redirect("error.php");
}
//VALIDATE INPUTS

$column = $_POST["selection"];
$fn = $_POST["firstname"];
$ln = $_POST["lastname"];
$change = $_POST["changeText"];

$finalChange = $change;

$edit_query2 = "UPDATE customer SET $column ='$finalChange' WHERE firstName LIKE '%$fn%' AND lastName LIKE '%$ln%'";
if ($column == "customerID" || $column == "zip")
{
	$finalChange = (int)$change;
	$edit_query2 = "UPDATE customer SET $column = $finalChange WHERE firstName LIKE '%$fn%' AND lastName Like '%$ln%'";
}
else
{
	$finalChange = filter_var($change, FILTER_SANITIZE_STRING);
	$finalChange = htmlentities($finalChange);
}

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 
 echo "<br>" . $edit_query2;
$result = mysqli_query($conn, $edit_query2);

if ($result) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

redirect("custlookup.php");
?>
