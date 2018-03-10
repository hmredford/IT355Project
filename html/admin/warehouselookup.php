<div><table>
    <tr><td><a href="admin.php"> Admin Home </a></td><td><a href="../logout.php"> log out </a></td></tr>
</table></div>
<div>
<table>
    <tr><td colspan='2'><h3>Warehouse Info</h3></td></tr>
	<tr>
		<th>warehouseID</th>
		<th>name</th>
		<th>address</th>
		<th>city</th>
		<th>state</th>
		<th>zip</th>
	</tr>


<?php

include "settings.php";
//VERIFY LOGIN
session_start();

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}//echo session_id();


if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

    redirect("../login.php");
}

//VERIFY INPUTS

if(!isset($_POST["wid"]))
{
    redirect("error.php");
}

 
$wid = $_POST["wid"];


echo "<br>Warehouse ID:" . $wid;




// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM warehouse WHERE warehouseID=$wid";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["warehouseID"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "<td>" . $row["state"] . "</td>";
        echo "<td>" . $row["zip"] . "</td></tr>";
    }
} 
else {
    echo "0 results";
}

?>

</table>
</div>


<div>
    <br>
<table>
    <tr><td colspan='2'><h3>Receiving</h3></td></tr>
    <tr>
        <th>merchOrder</th>
        <th>status</th>
        <th>orderDate</th>
        <th>paymentTotal</th>
        <th>Products</th>
        <th>employeeID</th>
        <th>carrier</th>
    </tr>


<?php

$sql2 = "SELECT DISTINCT receiving.merchOrder, receiving.status,
merchOrder.orderDate, merchOrder.paymentTotal, merchOrder.employeeID,
carrier.name
FROM receiving
LEFT JOIN merchOrder ON receiving.merchOrder=merchOrder.merchOrder
LEFT JOIN carrier ON receiving.carrierID=carrier.carrierID
WHERE receiving.warehouseID=$wid";

$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) 
{
    // output data of each row
    while($row2 = mysqli_fetch_assoc($result2)) 
    {
        echo "<tr><td>" . $row2["merchOrder"] . "</td>";
        echo "<td>" . $row2["status"] . "</td>";
        echo "<td>" . $row2["orderDate"] . "</td>";
        echo "<td>$" . $row2["paymentTotal"] . "</td><td>";
        
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

        echo "</td><td>" . $row2["employeeID"] . "</td>";
        echo "<td>" . $row2["name"] . "</td></tr>";
    }
} 
else {
    echo "0 results";
}

?>

</table>
</div>

<div id="page-back">
    <br>
    <h3>Verify Order Received</h3>
    <form action="verifymerch.php" method="post">
    <select name="order">
    <?php
    $sql4 = "SELECT merchOrder FROM receiving WHERE warehouseID=$wid";
    $result4 = mysqli_query($conn, $sql4);
    while ($row4 = mysqli_fetch_assoc($result4))
    {
        echo "<option value=\"" . $row4['merchOrder'] . "\">" . $row4['merchOrder'] . "</option>";
    }
    ?>
    </select>
    <input type="hidden" value="<?php echo $wid; ?>" name="wid"/>
    <input type="submit" id="submitverifymerch"/>
    </form>
</div>





<div>
    <br>
<table>
    <tr><td colspan='2'><h3>Shipping</h3></td></tr>
    <tr>
        <th>custOrder</th>
        <th>status</th>
        <th>orderDate</th>
        <th>paymentTotal</th>
        <th>Products</th>
        <th>customerID</th>
        <th>carrier</th>
    </tr>


<?php

$sql5 = "SELECT DISTINCT shipping.custOrder, shipping.status,
custOrder.orderDate, custOrder.paymentTotal, custOrder.customerID,
carrier.name
FROM shipping
LEFT JOIN custOrder ON shipping.custOrder=custOrder.custOrder
LEFT JOIN carrier ON shipping.carrierID=carrier.carrierID
WHERE shipping.warehouseID=$wid";

$result5 = mysqli_query($conn, $sql5);

if (mysqli_num_rows($result5) > 0) 
{
    // output data of each row
    while($row5 = mysqli_fetch_assoc($result5)) 
    {
        echo "<tr><td>" . $row5["custOrder"] . "</td>";
        echo "<td>" . $row5["status"] . "</td>";
        echo "<td>" . $row5["orderDate"] . "</td>";
        echo "<td>$" . $row5["paymentTotal"] . "</td><td>";
        
        $sql6 = "SELECT game.name, custOrderList.quantity
        FROM custOrderList
        INNER JOIN game ON custOrderList.productID = game.productID
        WHERE custOrderList.custOrder=" . $row5["custOrder"];
        $result6 = mysqli_query($conn, $sql6);        
            if (mysqli_num_rows($result6) > 0)
            {
                while($row6 = mysqli_fetch_assoc($result6)) 
                {
                echo $row6["name"] . " x " . $row6["quantity"] . "<br>";
                }
            }
            else {echo "0 results";}

        echo "</td><td>" . $row5["customerID"] . "</td>";
        echo "<td>" . $row5["name"] . "</td></tr>";
    }
} 
else {
    echo "0 results";
}

?>

</table>
</div>

<div id="page-back">
    <br>
    <h3>Verify Order Shipped</h3>
    You can only ship an order if you have enough of the product in inventory.
    <form action="verifyshipment.php" method="post">
    Order:<select name="order">
    <?php
    $sql5 = "SELECT DISTINCT shipping.custOrder
        FROM shipping
        LEFT JOIN custOrderList ON custOrderList.custOrder=shipping.custOrder
        LEFT JOIN inventory ON custOrderList.productID=inventory.productID
        WHERE shipping.warehouseID=$wid 
        AND inventory.quantity > custOrderList.quantity
        AND shipping.status LIKE'%ending%'";
    $result7 = mysqli_query($conn, $sql5);
    while ($row7 = mysqli_fetch_assoc($result7))
    {
        echo "<option value=\"" . $row7['custOrder'] . "\">" . $row7['custOrder'] . "</option>";
    }
    ?>
    </select>
    <br>Carrier name:
        <td>
        <select name="carrier">
            <?php
            $carriersql = "SELECT name, carrierID FROM carrier";
             $result7 = mysqli_query($conn, $carriersql);
            while($row7 = mysqli_fetch_assoc($result7)) 
            {
                echo "<option value=\"" . $row7['carrierID'] . "\">" . $row7['name'] . "</option>";
            }
            ?>
    </select>
    <input type="hidden" name="wid" value="<?php echo $wid;?>"/>
    <input type="submit" id="submitverifyship"/>
    </form>
</div>

<div id="page-back">
    <h3>Cancel Order</h3>
    <form action="cancel.php" method="post">
    <select name="order">
    <?php
    $result7 = mysqli_query($conn, $sql7);
    while ($row7 = mysqli_fetch_assoc($result7))
    {
        echo "<option value=\"" . $row7['custOrder'] . "\">" . $row7['custOrder'] . "</option>";
    }
    ?>
    </select>
    <input type="hidden" value="<?php echo $wid; ?>" name="wid"/>
    <input type="submit" id="submitcancelship"/>
    </form>
</div>



<div id = "page-back">
    
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
