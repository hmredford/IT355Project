<?

include "settings.php";
//VERIFY LOGIN
session_start();

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

    redirect("../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DBA Mongo</title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div><table>
	<tr><td><a href="dba.php"> DBA Home </a></td><td><a href="../logout.php"> log out </a></td></tr>
</table></div>

<div id="page-back">
	<h1>Mongo Info</h1>

	<h3>Backup Mongo database</h3>
	<a href = "mongobackup.php"><button>Back Up Now</button></a>
	<?php 

	$output = shell_exec('/usr/bin/python script/mongoinfo.py');
	echo $output;


	?>
</div>


</body>
</html> 


<?php 
mysqli_close($conn);
?>