
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

if(!isset($_POST["selectedGame"]) ||
!isset($_POST["selectedColumn"]) || 
!isset($_POST["changeText"]))
{
    redirect("error.php");
}
//VALIDATE INPUTS

$game = $_POST["selectedGame"];
$column = $_POST["selectedColumn"];
$change = $_POST["changeText"];

$finalChange = $change;
$editgame_query = "UPDATE game SET $column = '$finalChange' WHERE productID = $game";

if ($column == "productID" || $column == "numplayers" || $column == "playtime" )
{
	$finalChange = (int)$finalChange;
	$editgame_query = "UPDATE game SET $column = $finalChange WHERE productID = $game";
}
elseif ($column == "price")
{
	$finalChange = (float)$finalChange;
	$editgame_query = "UPDATE game SET $column = $finalChange WHERE productID = $game";
}
else
{
	$finalChange = filter_var($change, FILTER_SANITIZE_STRING);
	$finalChange = htmlentities($change);
}



// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = mysqli_query($conn, $editgame_query);


if ($result) {
    //echo "Record changed successfully";
} else {
    echo "Error: " . $editgame_query . "<br>" . $conn->error;
}

mysqli_close($conn);

redirect("viewgames.php");
?>
