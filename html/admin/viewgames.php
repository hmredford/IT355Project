<div><table>
    <tr><td><a href="admin.php"> Admin Home </a></td><td><a href="../logout.php"> log out </a></td></tr>
</table></div>
<div>

<table>
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
		
		<th>themes</th>
		<th>designer</th>
		<th>mechanics</th>
        <th>price</th>

	</tr>


<?php

session_start();
//echo session_id();

if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

    header("Location: ../login.php");
}
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

        echo "<td>" . $row["themes"]. "</td>";
        echo "<td>" . $row["designer"]. "</td>";
        echo "<td>" . $row["mechanics"] . "</td>";
        echo "<td>" . $row["price"] . "</td></tr>";
    }
} else {
    echo "0 results";
}
?>
</table>
</div>



<div id="page-back">
    <h3>Edit Game</h3>
    <form action="editgame.php" method="post">
    
    <select name="selectedGame">
        <?php
        $sql = "SELECT name, productID FROM game";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<option value=\"" . $row['productID'] . "\">" . $row['name'] . "</option>";
        }
        ?>
    </select>

    <select name = "selectedColumn">
        <?php
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'game'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<option value=\"" . $row['COLUMN_NAME'] . "\">" . $row['COLUMN_NAME'] . "</option>";
        }
        ?>
    </select>

        Change to: <input type="text" name="changeText" />
    
    <input type="submit" id="submitgameedit"/>
    </form>
</div>

<div id = "page-back">

    <form action="addgame.php" method="post">
    <table>
    <tr><td><h3>Add New Game</h3></td></tr>
    <tr><td>game name:</td> <td><input type="text" name="name" /></td></tr>
    <tr><td>game publisher: </td><td><input type="text" name="publisher" /></td></tr>
    <tr><td>game collection:</td><td> <input type="text" name="collection" /></td></tr>
    <tr><td>release date:</td><td> <input type="date" name="releasedate"></td></tr>
    <tr><td>number of Players:</td><td> <input type="number" name="numplayers" /></td></tr>
    <tr><td>Playtime: </td><td><input type="number" name="playtime" /></td></tr>
    <tr><td>age rating: </td><td><input type="text" name="agerating" /></td></tr>
    <tr><td>description:</td><td> <input type="textarea" name="description"/></td></tr>
    
    <tr><td>game themes:</td><td> <input type="text" name="themes" /></td></tr>
    <tr><td>game designer: </td><td><input type="text" name="designer" /></td></tr>
    <tr><td>game mechanics:</td><td> <input type="text" name="mechanics" /></td></tr>
    <tr><td>price:</td><td> <input type="text" name="price" /></td></tr>
    </table>
    <input type="submit" id="submitaddgame"/>
    </form>
</div>
<?php 
mysqli_close($conn);
?>