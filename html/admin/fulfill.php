<?php

//POST variable

include("settings.php");

$carriername = $_POST["carrier"];
$orderid = $_POST["order"];

echo "carrier:". $carriername;
echo "<br>order: " . $orderid;


$fulfill1 = "UPDATE shipping SET status='shipped', carrierID=(SELECT carrierID FROM carrier 
WHERE name LIKE '%$carriername%') WHERE custOrder=$orderid";

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
