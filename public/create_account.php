<?php 
	$db = mysqli_connect('MySQL_Hostname', 'MySQL_Username', 'MySQL_Password', 'MySQL_DB'); 
	// Check connection
	if (mysqli_connect_errno())
	{
	  echo "Err: " . mysqli_connect_error();
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
			echo "Err: " . $mysqli->error;
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