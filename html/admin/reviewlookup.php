<div><table>
    <tr><td><a href="admin.php"> Admin Home </a></td><td><a href="../logout.php"> log out </a></td></tr>
</table></div>
<div>

<table>
	<tr>
		<th>reviewID</th>
        <th>product</th>
		<th>rating</th>
		<th>reviewDate</th>
		<th>comment</th>
		<th>firstName</th>
		<th>lastName</th>
	</tr>


<?php
session_start();
//echo session_id();

if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

    header("Location: ../login.php");
}

$gameName = $_POST["reviewgame"];

echo "<br>game:" . $gameName;

include("settings.php");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT review.reviewID, review.rating, review.reviewDate, review.comment,
customer.firstName, customer.lastName, 
game.name
 FROM review
 INNER JOIN customer ON review.customerID=customer.customerID
 INNER JOIN game ON review.productID=game.productID 
 WHERE game.name='$gameName'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["reviewID"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["rating"] . "</td>";
        echo "<td>" . $row["reviewDate"] . "</td>";
        echo "<td>" . $row["comment"] . "</td>";
        echo "<td>" . $row["firstName"] . "</td>";
        echo "<td>" . $row["lastName"] . "</td></tr>";
    }
} 
else {
    echo "0 results";
}
?>

</table>
<div id = "page-back">
    <h3>Delete Review</h3>
    <form action="deletereview.php" method="post">
    <select name="review">
    <?php
    $sql2 = "SELECT reviewID FROM review WHERE productID=
    (SELECT productID FROM game WHERE name='$gameName')";
    $result2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_assoc($result2))
    {
        echo "<option value=\"" . $row2['reviewID'] . "\">" . $row2['reviewID'] . "</option>";
    }
    ?>
    </select>
    <input type="submit" id="submitdeletereview"/>
    </form>
</div>


<?php 
mysqli_close($conn);
?>
