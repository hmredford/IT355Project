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

if(!isset($_POST["name"]) ||
!isset($_POST["publisher"]) || 
!isset($_POST["collection"])||
!isset($_POST["releasedate"]) || 
!isset($_POST["numplayers"]) || 
!isset($_POST["agerating"])||
!isset($_POST["description"]) || 
//!isset($_POST["imagepath"])||
!isset($_POST["themes"]) || 
!isset($_POST["designer"]) || 
!isset($_POST["mechanics"]) || 
!isset($_POST["price"]) || 
!isset($_POST["playtime"]))
{
    redirect("error.php");
}
//VALIDATE INPUTS

$name = $_POST["name"];
$publisher = $_POST["publisher"];
$collection = $_POST["collection"];
$date = $_POST["releasedate"];
$numplayers = $_POST["numplayers"];
$playtime = $_POST["playtime"];
$agerating = $_POST["agerating"];
$description = $_POST["description"];
//$imagepath = $_POST["imagepath"];
$themes = $_POST["themes"];
$designer = $_POST["designer"];
$mechanics = $_POST["mechanics"];
$price = $_POST["price"];

if (!filter_var($playtime, FILTER_VALIDATE_INT) ||
!filter_var($numplayers, FILTER_VALIDATE_INT))
{
    redirect("error.php");
}

$name = filter_var($name, FILTER_SANITIZE_STRING);
$name = htmlentities($name);

$publisher = filter_var($publisher, FILTER_SANITIZE_STRING);
$publisher = htmlentities($publisher);

$collection = filter_var($collection, FILTER_SANITIZE_STRING);
$collection = htmlentities($collection);

$agerating = filter_var($agerating, FILTER_SANITIZE_STRING);
$agerating = htmlentities($agerating);

$description = filter_var($description, FILTER_SANITIZE_STRING);
$description = htmlentities($description);

$themes = filter_var($themes, FILTER_SANITIZE_STRING);
$themes = htmlentities($themes);

$designer = filter_var($designer, FILTER_SANITIZE_STRING);
$designer = htmlentities($designer);

$mechanics = filter_var($mechanics, FILTER_SANITIZE_STRING);
$mechanics = htmlentities($mechanics);

$price = (float)$price;
if (!filter_var($price, FILTER_VALIDATE_FLOAT))
{
	redirect("error.php");
}



// Create connection
// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 


$addgame_query = "INSERT INTO game (name, publisher, collection, releaseDate, numPlayers, playtime, ageRating, description, themes, designer, mechanics, price)
VALUES ('$name', '$publisher', '$collection', '$date', $numplayers, $playtime, '$agerating', '$description', '$themes', '$designer', '$mechanics', $price)";

$result = mysqli_query($conn, $addgame_query);

$newpid = mysqli_insert_id($conn);

if ($result) {
   // echo "New record created successfully";
} else {
    echo "Error: " . $addgame_query . "<br>" . $conn->error;
}

$inv_game = "SELECT productID FROM game";
$inv_ware = "SELECT warehouseID FROM warehouse";

$wareresult = mysqli_query($conn, $inv_ware);
	while ($ware = mysqli_fetch_assoc($wareresult))
	{
		$insert="INSERT INTO inventory(productID, warehouseID, quantity)
		VALUES ( $newpid , " . $ware["warehouseID"] . ", 0)";
		$insertr = mysqli_query($conn, $insert);
		if ($insertr) {
    	//echo "Record changed successfully";
} 		else {
   		 echo "Error: " . $insert . "<br>" . $conn->error;
}
			}




mysqli_close($conn);

redirect("viewgames.php");
?>
