<div><table>
    <tr><td><a href="admin.php"> Admin Home </a></td><td><a href="../logout.php"> log out </a></td></tr>
</table></div>
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
session_start();
//echo session_id();

if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

    header("Location: ../login.php");
}

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
} 
else {
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
        <th>warehouse</th>
        <th>status</th>
    </tr>

<?php

$orders_sql = "SELECT DISTINCT custOrder.custOrder,custOrder.orderDate, custOrder.paymentMethod, custOrder.paymentTotal, 
custOrder.paymentDate, custOrder.customerID, shipping.warehouseID, shipping.status
FROM custOrder 
LEFT JOIN shipping ON shipping.custOrder=custOrder.custOrder
WHERE custOrder.customerID=(SELECT customerID FROM customer WHERE firstName LIKE'%$firstname%' AND lastName LIKE'%$lastname%')";

$result2 = mysqli_query($conn, $orders_sql);

if (mysqli_num_rows($result2) > 0) 
{
    // output data of each row
    while($row2 = mysqli_fetch_assoc($result2)) 
    {
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

            if (mysqli_num_rows($result3) > 0) 
            {
                // output data of each row
                while($row3 = mysqli_fetch_assoc($result3)) 
                {
                     echo $row3['name'] . " x  " . $row3['quantity'] . "<br>";
                }
            } 
            else 
            {
                echo "0 results";
            }
            echo "</td>";
            
           $warehousesql = "SELECT name FROM warehouse 
            WHERE warehouseID = '" . $row2["warehouseID"] . "'";
            $result4 = mysqli_query($conn, $warehousesql);
            $row4 = mysqli_fetch_assoc($result4);
            echo "<td>" . $row4["name"] . "</td>";
            echo "<td>" . $row2["status"] . "</td>";

    }
} 
else {
    echo "0 results";
}
?>

</table>

</div>

<div id="page-back">
    <h3>Update Customer Info</h3>
    <form action="editcustomer.php" method="post">
    
    <select name = "selection">
        <?php
        $custcolsql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'customer'";
        $colresult = mysqli_query($conn, $custcolsql);
        while ($row = mysqli_fetch_assoc($colresult))
        {
            echo "<option value=\"" . $row['COLUMN_NAME'] . "\">" . $row['COLUMN_NAME'] . "</option>";
        }
        ?>
    </select>

        Change to: <input type="text" name="changeText" />
        <input type="hidden" name="firstname" value=<?php echo $firstname; ?> />
        <input type="hidden" name="lastname" value=<?php echo $lastname; ?> />

    <input type="submit" id="submitcustedit"/>
    </form>
</div>

<div id = "page-back">

    <form action="addtowarehouse.php" method="post">
    <table>
    <tr><td><h3>Assign Order to Warehouse</h3></td></tr>
    <tr><td>Customer Order number:</td> <td>
        <select name="order">
            <?php

            $ordersql2 = "SELECT custOrder from custOrder WHERE customerID=(SELECT customerID FROM customer WHERE firstName LIKE'%$firstname%' AND lastName LIKE'%$lastname%')";
             $result5 = mysqli_query($conn, $ordersql2);
            while($row5 = mysqli_fetch_assoc($result5)) 
            {
                echo "<option value=\"" . $row5['custOrder'] . "\">" . $row5['custOrder'] . "</option>";
            }
            ?>
        </select>
    </td></tr>
    <tr><td>warehouse ID: </td><td>
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
    </td></tr>
    </table>
    <input type="submit" id="submitaddtowarehouse"/>
    </form>
</div>

<div id="page-back">
    <h3>Cancel Shipment</h3>
    <form action="cancel.php" method="post">
    <table>
    <tr><td>Customer Order number:</td> <td>
        <select name="order">
            <?php
            $ordersql4 = "SELECT custOrder FROM custOrder 
            WHERE customerID=(SELECT customerID FROM customer WHERE firstName LIKE'%$firstname%' AND lastName LIKE'%$lastname%')";
             $result7 = mysqli_query($conn, $ordersql4);
            while($row7 = mysqli_fetch_assoc($result7)) 
            {
                echo "<option value=\"" . $row7['custOrder'] . "\">" . $row7['custOrder'] . "</option>";
            }
            ?>
        </select>
    </td> </tr>
    </table>
    <input type="submit" id="cancelsubmit"/>
    </form>
</div>

<div id = "page-back">
    <br>
    <form action="placecustorder.php" method="post">
    <table>
    <tr><td colspan='2'><h3>Place Order</h3></td></tr>
    <tr><td>product:</td><td><select name="pid">
    <?php
    $sql2 ="SELECT name, productID FROM game";
    $result2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_assoc($result2))
    {
        echo "<option value=\"" . $row2["productID"] . "\">" . $row2["name"] . "</option>";
    }
    ?>
    </select></td></tr>
    <tr><td>quantity:</td> <td><input type="number" name="quantity" /></td></tr>
    </table>
    <input type="hidden" value="<?php echo $firstname;?>" name="fn"/>
    <input type="hidden" value="<?php echo $lastname;?>" name="ln"/>
    <input type="submit" id="submitcustorder"/>
    </form>

</div>

<?php 
mysqli_close($conn);
?>
