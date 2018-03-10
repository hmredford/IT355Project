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
!isset($_POST["warehouse"]))
{
    redirect("error.php");
}
//VALIDATE INPUTS

$orderid = $_POST["order"];
$warehouse = $_POST["warehouse"];


$add_query = "INSERT INTO shipping (custOrder, warehouseID, status)
VALUES ($orderid, (SELECT warehouseID FROM warehouse WHERE name='$warehouse'), 'pending')";


if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = mysqli_query($conn, $add_query);


if ($result) {
   // echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

redirect("admin.php");
?>
