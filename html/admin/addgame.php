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

include("settings.php");

$name = $_POST["name"];
$publisher = $_POST["publisher"];
$collection = $_POST["collection"];
$date = $_POST["releasedate"];
//$date = date_format($date, "Y-m-d"); 
$numplayers = $_POST["numplayers"];
$playtime = $_POST["playtime"];
$agerating = $_POST["agerating"];
$description = $_POST["description"];
$imagepath = $_POST["imagepath"];
$themes = $_POST["themes"];
$designer = $_POST["designer"];
$mechanics = $_POST["mechanics"];

echo "name:". $name;
echo "<br>date:" . $date;
echo "<br>description:" . $description;

// Create connection
// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 


$addgame_query = "INSERT INTO game (name, publisher, collection, releaseDate, numPlayers, playtime, ageRating, description, imagePath, themes, designer, mechanics)
VALUES ('$name', '$publisher', '$collection', '$date', $numplayers, $playtime, '$agerating', '$description', '$imagepath', '$themes', '$designer', '$mechanics')";

$result = mysqli_query($conn, $addgame_query);

$newpid = mysqli_insert_id($conn);

if ($result) {
    echo "New record created successfully";
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
    	echo "Record changed successfully";
} 		else {
   		 echo "Error: " . $insert . "<br>" . $conn->error;
}
			}




mysqli_close($conn);

?>
