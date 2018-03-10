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


$warehouseName = $_POST["warehouse"];
echo "Employees at " . $warehouseName . "";
?>
<div>
    <table>
	<tr>
		<th>employeeID</th>
		<th>firstName</th>
		<th>lastName</th>
		<th>hireDate</th>
		<th>phone</th>
		<th>email</th>
		<th>address</th>
		<th>city</th>
		<th>state</th>
		<th>zip</th>
		<th>warehouseID</th>
		<th>position</th>

	</tr>

<?php


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM employee WHERE warehouseID = (SELECT warehouseID FROM warehouse WHERE name='" . $warehouseName . "')";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["employeeID"] . "</td>";
        echo "<td>" . $row["firstName"] . "</td>";
        echo "<td>" . $row["lastName"] . "</td>";
        echo "<td>" . $row["hireDate"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["city"]. "</td>";
        echo "<td>" . $row["state"]. "</td>";
        echo "<td>" . $row["zip"]. "</td>";
        echo "<td>" . $row["warehouseID"]. "</td>";
        echo "<td>" . $row["position"]. "</td>";
    }
} else {
    echo "0 results";
}

?>

</table>
</div>


<div id="page-back">
    <h3>Update Employee Info</h3>
    <form action="editemployee.php" method="post">
    
    <select name="selectedEmployee">
        <?php
        $sql = "SELECT employeeID, firstName, lastName FROM employee WHERE warehouseID = (SELECT warehouseID FROM warehouse WHERE name='$warehouseName')";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<option value=\"" . $row["employeeID"] . "\">" . $row['firstName'] . " " . $row['lastName'] . " " . $row["employeeID"] . "</option>";
        }
        ?>
    </select>

    <select name = "selectedColumn">
        <?php
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'employee'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<option value=\"" . $row['COLUMN_NAME'] . "\">" . $row['COLUMN_NAME'] . "</option>";
        }
        ?>
    </select>

        Change to: <input type="text" name="changeText" />
    
    <input type="submit" id="submitemployeeedit"/>
    </form>
</div>

<div id = "page-back">

    <form action="addemployee.php" method="post">
    <table>
    <tr><td colspan=2><h3>Add New Employee</h3></td></tr>
    <tr><td>firstname:</td> <td><input type="text" name="firstname" /></td></tr>
    <tr><td>lastname: </td><td><input type="text" name="lastname" /></td></tr>
    <tr><td>hire date:</td><td> <input type="date" name="hiredate" /></td></tr>
    <tr><td>phone:</td><td> <input type="number" name="phone"></td></tr>
    <tr><td>email:</td><td> <input type="text" name="email" /></td></tr>
    <tr><td>street address: </td><td><input type="text" name="address" /></td></tr>
    <tr><td>city: </td><td><input type="text" name="city" /></td></tr>
    <tr><td>state:</td><td> <input type="text" name="state"/></td></tr>
    <tr><td>zip:</td><td> <input type="number" name="zip" /></td></tr>
    <tr><td>position:</td><td> <input type="text" name="position" /></td></tr>
    </table>
    <select name="warehouse">
    <?php
    $sql = "SELECT name FROM warehouse";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<option value=\"" . $row['name'] . "\">" . $row['name'] . "</option>";
    }
    ?>
    </select>
    <input type="submit" id="submitaddemployee"/>
    </form>
</div>

<?php 
mysqli_close($conn);
?>