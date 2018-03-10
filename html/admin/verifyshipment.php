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

if(!isset($_POST["order"]) ||
!isset($_POST["wid"]) || 
!isset($_POST["carrier"]))
{
    redirect("error.php");
}

$order = $_POST["order"];
$wid = $_POST["wid"];
$cid = $_POST["carrier"];




$quantity = "SELECT quantity, productID
FROM custOrderList WHERE custOrder=$order";
$result2 = mysqli_query($conn, $quantity);
while ($row=mysqli_fetch_assoc($result2))
{
	$update = "UPDATE inventory SET quantity=quantity-" . $row["quantity"] . 
	" WHERE productID=" . $row["productID"] . " AND warehouseID=$wid" ;
	$result2 = mysqli_query($conn, $update);
	if ($result2) {

            $sql = "UPDATE shipping SET status='shipped', carrierID=$cid
        WHERE custOrder=$order";

        if (!$conn) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $result = mysqli_query($conn, $sql);


        if ($result) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
	} else {
    	echo "Error: " . $update . "<br>" . $conn->error;
	}
}

mysqli_close($conn);

redirect("admin.php");

?>
