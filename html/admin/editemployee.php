<?php

//POST variable

include("settings.php");

$eid = $_POST["selectedEmployee"];
$column = $_POST["selectedColumn"];
$change = $_POST["changeText"];

echo "eID:". $eid;
echo "<br>column: " . $column;
echo "<br>change:" . $change;

$finalChange = $change;

$edit_query = "UPDATE employee SET $column = '$finalChange' WHERE employeeID =$eid";
if ($column == "employeeID" || $column == "zip"|| $column == "warehouseID")
{
	$finalChange = (int)$change;
	$edit_query = "UPDATE employee SET $column = $finalChange WHERE employeeID =$eid";
}


// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = mysqli_query($conn, $edit_query);


if ($result) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>
