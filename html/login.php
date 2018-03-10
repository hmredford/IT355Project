
<?php
session_start();
//echo session_id();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hayden Redford</title>
</head>
<body>

<div id = "page-back">

<?php
if(!isset($_SESSION["userid"]))
{

  $_SESSION["status"] = "not logged in";
}
else 
{
  $_SESSION["status"] = "you are logged in!";
}


 echo "user: " . $_SESSION["status"]
 ?>

<h3>Log In</h3>

<form action="query.php" method="post">
username: <input type="text" name="fusername" />
password: <input type="password" name="fpassword" />
<input type="submit" id="submitlogin"/>
</form>

<?php 
if (isset($_SESSION["invalid"]))
{
	echo $_SESSION["invalid"];
	//echo "invalid login";
}



//if (isset($_SESSION["attempts"]) && $_SESSION["attempts"] > 0)
//{

//	echo "<br>Invalid login. Please check your username and password and try again.";
//}
?>




</div>
</body>
</html> 
