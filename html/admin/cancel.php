<?php

//POST variable

include("settings.php");

$orderid = $_POST["order"];

echo "<br>order: " . $orderid;


$fulfill1 = "UPDATE shipping SET status='canceled' WHERE custOrder=$orderid";

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$result1 = mysqli_query($conn, $fulfill1);


if ($result1) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>
