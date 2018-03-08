<div>

<table>
	<tr>
		<th>customerID</th>
		<th>username</th>
		<th>firstName</th>
		<th>lastName</th>
		<th>email</th>
		<th>address</th>
		<th>city</th>
		<th>state</th>
		<th>zip</th>
	</tr>


<?php
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];

echo "<br>" . $firstname;
echo "<br>" . $lastname;

include("settings.php");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM customer WHERE firstName LIKE'%$firstname%' AND lastName LIKE'%$lastname%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["customerID"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["firstName"] . "</td>";
        echo "<td>" . $row["lastName"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "<td>" . $row["state"]. "</td>";
        echo "<td>" . $row["zip"]. "</td>";
    }
} else {
    echo "0 results";
}

?>
</table>
</div>

<div>
<table>
    <tr>
        <th>custOrder</th>
        <th>orderDate</th>
        <th>paymentMethod</th>
        <th>paymentTotal</th>
        <th>paymentDate</th>
        <th>customerID</th>
        <th>custOrderList</th>
    </tr>

<?php

$orders_sql = "SELECT * FROM custOrder WHERE customerID=(SELECT customerID FROM customer WHERE firstName LIKE'%$firstname%' AND lastName LIKE'%$lastname%')";
$result2 = mysqli_query($conn, $orders_sql);

if (mysqli_num_rows($result2) > 0) {
    // output data of each row
    while($row2 = mysqli_fetch_assoc($result2)) {
        echo "<tr><td>" . $row2["custOrder"] . "</td>";
        echo "<td>" . $row2["orderDate"] . "</td>";
        echo "<td>" . $row2["paymentMethod"] . "</td>";
        echo "<td>" . $row2["paymentTotal"] . "</td>";
        echo "<td>" . $row2["paymentDate"] . "</td>";
        echo "<td>" . $row2["customerID"] . "</td>";
        echo "<td>";

        $listsql = "SELECT game.name, custOrderList.quantity 
        FROM game 
        INNER JOIN custOrderList ON custOrderList.productID=game.productID
        WHERE custOrderList.custOrder= " . $row2['custOrder'];
        $result3 = mysqli_query($conn, $listsql);

        if (mysqli_num_rows($result3) > 0) {
        // output data of each row
        while($row3 = mysqli_fetch_assoc($result3)) {
            echo $row3['quantity'] . " x  " . $row3['name'] . "<br>";
            }
            echo "</td></tr>";
         } else {
    echo "0 results";
            }   
    }
} else {
    echo "0 results";
}
?>

</table>

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
    <tr><td>image path:</td><td> <input type="text" name="imagepath" /></td></tr>
    <tr><td>game themes:</td><td> <input type="text" name="themes" /></td></tr>
    <tr><td>game designer: </td><td><input type="text" name="designer" /></td></tr>
    <tr><td>game mechanics:</td><td> <input type="text" name="mechanics" /></td></tr>
    </table>
    <input type="submit" id="submitaddgame"/>
    </form>
</div>

<div id="page-back">
    <h3>Edit Game</h3>
    <form action="editgame.php" method="post">
    
    <select name="selectedGame">
        <?php
        $sql = "SELECT name FROM game";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<option value=\"" . $row['name'] . "\">" . $row['name'] . "</option>";
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


<?php 
mysqli_close($conn);
?>
