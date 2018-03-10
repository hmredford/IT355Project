
<?php

session_start();
//echo session_id();

if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

	header("Location: ../login.php");
}

include("settings.php");

$gameName = $_POST["selectedGame"];
$column = $_POST["selectedColumn"];
$change = clean_input($_POST["changeText"]);

$finalChange = $change;
$editgame_query = "UPDATE game SET $column = '$finalChange' WHERE name = '$gameName'";

if ($column == "productID" || $column == "numplayers" || $column == "playtime" )
{
	$finalChange = (int)$finalChange;
	$editgame_query = "UPDATE game SET $column = $finalChange WHERE name = '$gameName'";
}
if ($column == "productID")
{
	$finalChange = floatval($finalChange);
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

header("viewgames.php");
?>
