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

include("settings.php");

$column = $_POST["selection"];
$fn = $_POST["firstname"];
$ln = $_POST["lastname"];
$change = $_POST["changeText"];

echo "sel:". $column;
echo "<br>first: " . $fn;
echo "<br>last: " . $ln;
echo "<br>change:" . $change;


$finalChange = $change;

$edit_query2 = "UPDATE customer SET $column ='$finalChange' WHERE firstName LIKE '%$fn%' AND lastName LIKE '%$ln%'";
if ($column == "customerID" || $column == "zip")
{
	$finalChange = (int)$change;
	$edit_query2 = "UPDATE customer SET $column = $finalChange WHERE firstName LIKE '%$fn%' AND lastName Like '%$ln%'";
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

?>
