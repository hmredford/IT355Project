<?php

//POST variable

include("settings.php");

$orderid = $_POST["order"];
$warehouse = $_POST["warehouse"];

echo "<br>orderid: " . $orderid;
echo "<br>warehouse:" . $warehouse;

$add_query = "INSERT INTO shipping (custOrder, warehouseID, status)
VALUES ($orderid, (SELECT warehouseID FROM warehouse WHERE name='$warehouse'), 'Pending')";


if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = mysqli_query($conn, $add_query);


if ($result) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>
