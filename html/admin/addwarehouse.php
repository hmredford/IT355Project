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

if(!isset($_POST["name"]) ||
!isset($_POST["address"]) || 
!isset($_POST["city"])||
!isset($_POST["state"]) || 
!isset($_POST["zip"]))
{
    redirect("error.php");
}
//VALIDATE INPUTS

$name = $_POST["name"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];

if (!filter_var($zip, FILTER_VALIDATE_INT))
{
    redirect("error.php");
}
$name = filter_var($name, FILTER_SANITIZE_STRING);
$name = htmlentities($name);

$address = filter_var($address, FILTER_SANITIZE_STRING);
$address = htmlentities($address);

$city = filter_var($city, FILTER_SANITIZE_STRING);
$city = htmlentities($city);

$state = filter_var($state, FILTER_SANITIZE_STRING);
$state = htmlentities($state);



// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 


$add_query = "INSERT INTO warehouse (name, address, city, state, zip)
VALUES ('$name', '$address', '$city', '$state', $zip)";

$result = mysqli_query($conn, $add_query);


if ($result) {
   // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);
redirect("admin.php");

?>
