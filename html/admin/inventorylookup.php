<div><table>
    <tr><td><a href="admin.php"> Admin Home </a></td><td><a href="../logout.php"> log out </a></td></tr>
</table></div>
<div>
<table>
    <tr><td colspan='2'><h3>Warehouse Inventory</h3></td></tr>
	<tr>
		<th>Product</th>
		<th>quantity</th>
	</tr>


<?php
session_start();
//echo session_id();

if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

    header("Location: ../login.php");
}

$wid = $_POST["wid"];

echo "<br>Warehouse ID:" . $wid;


include("settings.php");
session_start();
//echo session_id();

if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

    header("Location: ../login.php");
}
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT game.name, inventory.quantity
FROM game
LEFT JOIN inventory ON inventory.productID=game.productID
WHERE inventory.warehouseID=$wid";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["name"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td></tr>";
    }
} 
else {
    echo "0 results";
}

?>

</table>
</div>

<div id = "page-back">
    <br>
    <form action="placeorder.php" method="post">
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
    <tr><td>payment method: </td><td><input type="text" name="method" /></td></tr>
    <tr><td>employeeID:</td><td> <input type="text" name="eid" /></td></tr>
    <tr><td>supplier:</td><td><select name="sid">
    <?php
    $sql3 ="SELECT name, supplierID FROM supplier";
    $result3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_assoc($result3))
    {
        echo "<option value=\"" . $row3["supplierID"] . "\">" . $row3["name"] . "</option>";
    }
    ?>
    </select></td></tr>
    </table>
    <input type="hidden" value="<?php echo $wid;?>" name="wid"/>
    <input type="submit" id="submitmerchorder"/>
    </form>

</div>





<div>
    <br>
<table>
    <tr><td colspan='2'><h3>Merchandise Orders</h3></td></tr>
    <tr>
        <th>merchOrder</th>
        <th>status</th>
        <th>orderDate</th>
        <th>paymentMethod</th>
        <th>paymentTotal</th>
        <th>paymentDate</th>
        <th>Products</th>
         <th>supplier</th>
        <th>employeeID</th>
    </tr>


<?php

$sql2 = "SELECT merchOrder.merchOrder, orderDate, paymentMethod, paymentTotal, paymentDate, employeeID, supplierID, status
 FROM merchOrder
LEFT JOIN receiving ON receiving.merchOrder = merchOrder.merchOrder
WHERE receiving.status !='canceled' AND receiving.warehouseID=$wid
ORDER BY orderDate DESC LIMIT 20";

$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) 
{
    // output data of each row
    while($row2 = mysqli_fetch_assoc($result2)) 
    {
        echo "<tr><td>" . $row2["merchOrder"] . "</td>";
        echo "<td>" . $row2["status"] . "</td>";
        echo "<td>" . $row2["orderDate"] . "</td>";
        echo "<td>" . $row2["paymentMethod"] . "</td>";
        echo "<td>$" . $row2["paymentTotal"] . "</td>";
        echo "<td>$" . $row2["paymentDate"] . "</td><td>";
        
        $sql3 = "SELECT game.name, merchOrderList.quantity
        FROM merchOrderList
        INNER JOIN game ON merchOrderList.productID = game.productID
        WHERE merchOrderList.merchOrder=" . $row2["merchOrder"];
        $result3 = mysqli_query($conn, $sql3);        
            if (mysqli_num_rows($result3) > 0)
            {
                while($row3 = mysqli_fetch_assoc($result3)) 
                {
                echo $row3["name"] . " x " . $row3["quantity"] . "<br>";
                }
            }
            else {echo "0 results";}

        echo "</td><td>" . $row2["supplierID"] . "</td>";
        echo "<td>" . $row2["employeeID"] . "</td></tr>";
    }
} 
else {
    echo "0 results";
}

?>

</table>
</div>


<div id = "page-back">

    <form action="addtowarehousemerch.php" method="post">
    <table>
    <tr><td colspan='2'><h3>Assign Order to Other Warehouse</h3></td></tr>
    <tr><td>Order number:</td> <td>
        <select name="order">
            <?php
             $result4 = mysqli_query($conn, $sql2);
            while($row4 = mysqli_fetch_assoc($result4)) 
            {
                echo "<option value=\"" . $row4['merchOrder'] . "\">" . $row4['merchOrder'] . "</option>";
            }
            ?>
        </select>
    </td></tr>
    <tr><td>warehouse ID: </td><td>
        <select name="warehouse">
            <?php
            $sql = "SELECT name, warehouseID FROM warehouse";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<option value=\"" . $row['warehouseID'] . "\">" . $row['name'] . "</option>";
            }
            ?>
        </select>
    </td></tr>
    </table>
    <input type="submit" id="submitaddtowarehouse"/>
    </form>
</div>


<div id = "page-back">

    <form action="cancelmerch.php" method="post">
    <table>
    <tr><td colspan='2'><h3>Cancel Order</h3></td></tr>
    <tr><td>Order number:</td> <td>
        <select name="order">
            <?php
             $result4 = mysqli_query($conn, $sql2);
            while($row4 = mysqli_fetch_assoc($result4)) 
            {
                echo "<option value=\"" . $row4['merchOrder'] . "\">" . $row4['merchOrder'] . "</option>";
            }
            ?>
        </select>
    </td><td><input type="submit" id="submitcancelmerch"/></td></tr>
    </table>
    
    </form>
</div>




<div id = "page-back">
    <br><br>
    <form action="addwarehouse.php" method="post">
    <table>
        <tr><td colspan='2'><h3>Add New Warehouse</h3></td></tr>
    <tr><td>name:</td> <td><input type="text" name="name" /></td></tr>
    <tr><td>address: </td><td><input type="text" name="address" /></td></tr>
    <tr><td>city:</td><td> <input type="text" name="city" /></td></tr>
    <tr><td>state:</td><td> <input type="text" name="state" /></td></tr>
    <tr><td>zip: </td><td><input type="number" name="zip" /></td></tr>
    </table>
    <input type="submit" id="submitaddwarehouse"/>
    </form>

</div>

<?php 
mysqli_close($conn);
?>
