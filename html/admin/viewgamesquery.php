<?php

echo "<table>
	<tr>
		<th>productID</th>
		<th>name</th>
		<th>publisher</th>
		<th>collection</th>
		<th>releaseDate</th>
		<th>numPlayers</th>
		<th>playtime</th>
		<th>ageRating</th>
		<th>description</th>
		<th>imagePath</th>
		<th>themes</th>
		<th>designer</th>
		<th>mechanics</th>

	</tr>";


//POST variable

include("settings.php");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM game";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["productID"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["publisher"] . "</td>";
        echo "<td>" . $row["collection"] . "</td>";
        echo "<td>" . $row["releaseDate"] . "</td>";
        echo "<td>" . $row["numPlayers"] . "</td>";
        echo "<td>" . $row["playtime"] . "</td>";
        echo "<td>" . $row["ageRating"]. "</td>";
        echo "<td>" . $row["description"]. "</td>";
        echo "<td>" . $row["imagePath"]. "</td>";
        echo "<td>" . $row["themes"]. "</td>";
        echo "<td>" . $row["designer"]. "</td>";
        echo "<td>" . $row["mechanics"] . "</td></tr>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);


?>