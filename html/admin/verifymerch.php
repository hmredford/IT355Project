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

$order = $_POST["order"];
$wid = $_POST["wid"];

echo "order: " . $order;


$fulfill = "UPDATE receiving SET status='received'
WHERE merchOrder=$order";

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = mysqli_query($conn, $fulfill);


if ($result) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$quantity = "SELECT quantity, productID
FROM merchOrderList WHERE merchOrder=$order";
$result2 = mysqli_query($conn, $quantity);
while ($row=mysqli_fetch_assoc($result2))
{
	$update = "UPDATE inventory SET quantity=quantity+" . $row["quantity"] . 
	" WHERE warehouseID=$wid AND productID=" . $row["productID"];
	$result2 = mysqli_query($conn, $update);
	if ($result2) {
    echo "Record changed successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

mysqli_close($conn);

?>
