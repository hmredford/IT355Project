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

if(!isset($_POST["carrier"]) ||
!isset($_POST["order"]))
{
    redirect("error.php");
}
//VALIDATE INPUTS

$carriername = $_POST["carrier"];
$orderid = $_POST["order"];



$fulfill1 = "UPDATE shipping SET status='shipped', carrierID=(SELECT carrierID FROM carrier 
WHERE name LIKE '%$carriername%') WHERE custOrder=$orderid";

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$result1 = mysqli_query($conn, $fulfill1);


if ($result1) {
   // echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);
redirect("admin.php");
?>
