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

$carriername = $_POST["carrier"];
$orderid = $_POST["order"];

echo "carrier:". $carriername;
echo "<br>order: " . $orderid;


$fulfill1 = "UPDATE shipping SET status='shipped', carrierID=(SELECT carrierID FROM carrier 
WHERE name LIKE '%$carriername%') WHERE custOrder=$orderid";

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$result1 = mysqli_query($conn, $fulfill1);


if ($result1) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>
