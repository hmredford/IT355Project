<?php

//POST variable

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


if ($result) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>
