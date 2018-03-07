<?php

echo "<table>
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
		<th>supervisiorID</th>

	</tr>";


//POST variable

include("settings.php");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM employee";
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
        echo "<td>" . $row["supervisiorID"] . "</td></tr>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);


?>