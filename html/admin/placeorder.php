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

if(!isset($_POST["pid"]) ||
!isset($_POST["quantity"]) || 
!isset($_POST["method"])||
!isset($_POST["eid"]) || 
!isset($_POST["sid"]) || 
!isset($_POST["wid"]))
{
    redirect("error.php");
}
//VALIDATE INPUTS

$pid = $_POST["pid"];
$quantity = $_POST["quantity"];
$method = $_POST["method"];
$eid = $_POST["eid"];
$sid = $_POST["sid"];
$wid = $_POST["wid"];

if (!filter_var($quantity, FILTER_VALIDATE_INT) ||
!filter_var($eid, FILTER_VALIDATE_INT))
{
    redirect("error.php");
}
$method = filter_var($method, FILTER_SANITIZE_STRING);
$method = htmlentities($method);


$priceq = "SELECT price FROM game WHERE productID=$pid";

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$pricer = mysqli_query($conn, $priceq);
$price=mysqli_fetch_assoc($pricer);
$totalprice = $price["price"] * $quantity;

$sql = "INSERT INTO merchOrder(orderDate,paymentMethod,paymentTotal,PaymentDate,employeeID,supplierID)
	VALUES(CURRENT_TIMESTAMP, '$method',$totalprice, CURRENT_TIMESTAMP,$eid,$sid)";

$result = mysqli_query($conn, $sql);

if ($result) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = "INSERT INTO merchOrderList(merchOrder,productID, quantity)
VALUES((LAST_INSERT_ID()),$pid,$quantity);";

$result2 = mysqli_query($conn, $sql2);

if ($result2) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$sql3 = "INSERT INTO receiving (merchOrder,warehouseID,status)
VALUES((LAST_INSERT_ID()),$wid,'pending');";

$result3 = mysqli_query($conn, $sql3);

if ($result2) {
} else {
    echo "Receiving Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);

redirect("admin.php");
?>
