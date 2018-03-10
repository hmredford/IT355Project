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

$pid = $_POST["pid"];
$quantity = $_POST["quantity"];
$method = $_POST["method"];
$eid = $_POST["eid"];
$sid = $_POST["sid"];
$wid = $_POST["wid"];


echo "<br>product: " . $pid;

$priceq = "SELECT price FROM game WHERE productID=$pid";

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$pricer = mysqli_query($conn, $priceq);
$price=mysqli_fetch_assoc($pricer);
$totalprice = $price["price"] * $quantity;

echo "<br> price:$totalprice<br>";

$sql = "INSERT INTO merchOrder(orderDate,paymentMethod,paymentTotal,PaymentDate,employeeID,supplierID)
	VALUES(CURRENT_TIMESTAMP, '$method',$totalprice, CURRENT_TIMESTAMP,$eid,$sid)";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = "INSERT INTO merchOrderList(merchOrder,productID, quantity)
VALUES((LAST_INSERT_ID()),$pid,$quantity);";

$result2 = mysqli_query($conn, $sql2);

if ($result2) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$sql3 = "INSERT INTO receiving (merchOrder,warehouseID,status)
VALUES((LAST_INSERT_ID()),$wid,'pending');";

$result3 = mysqli_query($conn, $sql3);

if ($result2) {
    echo "Record changed successfully";
} else {
    echo "Receiving Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);

?>
