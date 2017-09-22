<?php
	$DBInfo = file_get_contents("../mysql.json");
	$DBInfo = json_decode($DBInfo, true);
	$db = mysqli_connect($DBInfo["Host"], $DBInfo["User"], $DBInfo["Pass"], $DBInfo["DB"]); 
	// Check connection
	if(empty($_GET['User']) || empty($_GET['Pass']) || empty($_GET['hash']))
	{
		echo "Err: Parameters missing";
		exit;
	}
	if (mysqli_connect_errno())
	{
	  echo "Err: Connection Code " . mysqli_connect_error();
	  exit;
	}

	// Strings must be escaped to prevent SQL injection attack. 
	$name = mysqli_real_escape_string($db, $_GET['User']); 
	$pass = mysqli_real_escape_string($db, $_GET['Pass']); 
	$hash = $_GET['hash']; 

	$secretKey = "farmersAreCool";

	$real_hash = md5($name . $pass . $secretKey); 
	if($real_hash == $hash) 
	{ 
		// Send variables for the MySQL database class.
		$pass = password_hash($pass);
		$query = "INSERT INTO User ('Username', 'Password', 'Join_date', 'Currency') VALUES ('$name', '$pass', CURRENT_DATE, 0);"; 
		$result = mysqli_query($db, $query); 
		if (!result) 
		{
			echo "Err: Query Code " . $mysqli->error;
			exit;
		}
		else
		{
			echo "Success";
		}
	}
	else
	{
		echo "Err: Failed Hash";
	}
?>