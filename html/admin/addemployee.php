<?php

//POST variable

include("settings.php");

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

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 


$add_query = "INSERT INTO employee (firstName, lastName, hireDate, phone, email, address, city, state, zip, warehouseID, position)
VALUES ('$firstname', '$lastname', '$hiredate', $phone, '$email', '$address', '$city', '$state', $zip, (SELECT warehouseID FROM warehouse WHERE name='$warehouse'), '$position')";

$result = mysqli_query($conn, $add_query);


if ($result) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>
