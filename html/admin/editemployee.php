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

if(!isset($_POST["selectedEmployee"]) ||
!isset($_POST["selectedColumn"]) || 
!isset($_POST["changeText"]))
{
    //redirect("error.php");
}
//VALIDATE INPUTS

$eid = $_POST["selectedEmployee"];
$column = $_POST["selectedColumn"];
$change = $_POST["changeText"];


$finalChange = $change;

$edit_query = "UPDATE employee SET $column = '$finalChange' WHERE employeeID =$eid";
if ($column == "employeeID" || $column == "zip"|| $column == "warehouseID" || $column == "phone")
{
	$finalChange = (int)$change;
	$edit_query = "UPDATE employee SET $column = $finalChange WHERE employeeID =$eid";
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

$result = mysqli_query($conn, $edit_query);


if ($result) {
    //echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

redirect("admin.php");

?>
