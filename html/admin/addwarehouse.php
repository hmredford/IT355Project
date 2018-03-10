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

$name = $_POST["name"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 


$add_query = "INSERT INTO warehouse (name, address, city, state, zip)
VALUES ('$name', '$address', '$city', '$state', $zip)";

$result = mysqli_query($conn, $add_query);


if ($result) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>
