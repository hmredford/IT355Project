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
$first = $_POST["fn"];
$last = $_POST["ln"];


echo "<br>product: " . $pid;

$priceq = "SELECT price FROM game WHERE productID=$pid";

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$pricer = mysqli_query($conn, $priceq);
$price=mysqli_fetch_assoc($pricer);
$totalprice = $price["price"] * $quantity;

echo "<br> price:$totalprice<br>";

$sql = "INSERT INTO custOrder(orderDate,paymentMethod,paymentTotal,PaymentDate,customerID)
	VALUES(CURRENT_TIMESTAMP, 'PayPal',$totalprice, CURRENT_TIMESTAMP,(
	SELECT customerID from customer WHERE firstName LIKE '%$first%' 
	AND lastName LIKE '%$last%'))";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = "INSERT INTO custOrderList(custOrder,productID, quantity)
VALUES((LAST_INSERT_ID()),$pid,$quantity);";

$result2 = mysqli_query($conn, $sql2);

if ($result2) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$sql3 = "INSERT INTO shipping (custOrder,warehouseID,status)
VALUES((LAST_INSERT_ID()),1,'pending');";

$result3 = mysqli_query($conn, $sql3);

if ($result2) {
    echo "Record changed successfully";
} else {
    echo "Receiving Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);

?>
