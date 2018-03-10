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

include("settings.php");

$oid = $_POST["order"];
$wid = $_POST["warehouse"];

echo "<br>orderid: " . $oid;
echo "<br>warehouse:" . $wid;

$add_query = "INSERT INTO receiving (merchOrder, warehouseID, status)
VALUES ($oid, $wid, 'pending')";


if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = mysqli_query($conn, $add_query);


if ($result) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>
