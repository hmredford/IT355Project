<?php

//POST variable

include("settings.php");

$gameName = $_POST["selectedGame"];
$column = $_POST["selectedColumn"];
$change = $_POST["changeText"];

echo "game name:". $gameName;
echo "<br>column: " . $column;
echo "<br>change:" . $change;

$finalChange = $change;
$editgame_query = "UPDATE game SET $column = '$finalChange' WHERE name = '$gameName'";

if ($column == "productID" || $column == "numplayers" || $column == "playtime")
{
	$finalChange = (int)$finalChange;
	$editgame_query = "UPDATE game SET $column = $finalChange WHERE name = '$gameName'";
}


// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = mysqli_query($conn, $editgame_query);


if ($result) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>
