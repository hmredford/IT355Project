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
//POST variable

include("settings.php");

$review = $_POST["review"];

echo "<br>review:" . $review;



$query = "DELETE FROM review WHERE reviewID=$review";

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 
 echo "<br>" . $query;
$result = mysqli_query($conn, $query);

if ($result) {
    echo "Record changed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

?>
