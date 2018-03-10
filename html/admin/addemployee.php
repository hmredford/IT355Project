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

if(!isset($_POST["firstname"]) ||
!isset($_POST["lastname"]) || 
!isset($_POST["hiredate"])||
!isset($_POST["phone"]) || 
!isset($_POST["email"]) || 
!isset($_POST["address"])||
!isset($_POST["city"]) || 
!isset($_POST["state"]) || 
!isset($_POST["zip"]) || 
!isset($_POST["position"]) || 
!isset($_POST["warehouse"]))
{
    redirect("error.php");
}
//VALIDATE INPUTS

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$hiredate = $_POST["hiredate"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$position = $_POST["position"];
$warehouse = $_POST["warehouse"];

if (!filter_var($zip, FILTER_VALIDATE_INT) ||
!filter_var($phone, FILTER_VALIDATE_INT))
{
    redirect("error.php");
}

$firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
$firstname = htmlentities($firstname);

$lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
$lastname = htmlentities($lastname);

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = htmlentities($email);
if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
	redirect("error.php");
}

$address = filter_var($address, FILTER_SANITIZE_STRING);
$address = htmlentities($address);

$city = filter_var($city, FILTER_SANITIZE_STRING);
$city = htmlentities($city);

$state = filter_var($state, FILTER_SANITIZE_STRING);
$state = htmlentities($state);

$position = filter_var($position, FILTER_SANITIZE_STRING);
$position = htmlentities($position);



// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 


$add_query = "INSERT INTO employee (firstName, lastName, hireDate, phone, email, address, city, state, zip, warehouseID, position)
VALUES ('$firstname', '$lastname', '$hiredate', $phone, '$email', '$address', '$city', '$state', $zip, (SELECT warehouseID FROM warehouse WHERE name='$warehouse'), '$position')";

$result = mysqli_query($conn, $add_query);


if ($result) {
   // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

redirect("viewemployees.php");

?>
