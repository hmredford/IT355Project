<?php

session_start();
//echo session_id();
include("admin/settings.php");

//POST variable

$username = $_POST["fusername"];
$password = $_POST["fpassword"];
$password_hashed = hash('sha256', $_POST["fpassword"]);



// CHECK CONNECTION
if (!$conn){
  die("Connection Failed: " . mysqli_connect_error());
   
}



// SEND QUERY
//if (isset($username) && isset($password_hashed)) {

$userid_query = "SELECT userID FROM users WHERE username= '$username' AND password= '$password_hashed' LIMIT 1";
$result = mysqli_query($conn, $userid_query);


	if($result) //IF SOMETHING IS IN THE QUERY
	{

  
  	$value = mysqli_fetch_assoc($result);

	$_SESSION["userid"] = $value["userID"];
	
		//if(isset($_SESSION["invalid"])){
		//unset($_SESSION["invalid"]);
		//}
	
	
	//$_SESSION["loggedin"] = "yes";
	

	//echo "userid is :" . $_SESSION["userid"];
	
	$setlogin = "UPDATE $usertable SET loggedin=1 WHERE userId='" . $_SESSION["userid"]. "'";
	$result = mysqli_query($conn, $setlogin);

	
	//mysqli_close($db_conn);

	header("Location: admin/admin.php");


  
	}
	else {

	//mysqli_close($db_conn);
	

{
	$_SESSION["invalid"] = "Invalid Login. Please try again." . $password_hashed;
}
	
	header("Location: login.php");
	
	//echo "didnt work";
	//echo " result is: " . $result;

	}

//}
//else {

	
//	print_r($_POST);
//	mysqli_close($db_conn);
	
	//$_SESSION["loggedin"] = "invalid";
//	$_SESSION["attempts"] = $_SESSION["attempts"] + 1;
	
//	header("Location: login.php");
	//echo "variables not set";
//}
?>
