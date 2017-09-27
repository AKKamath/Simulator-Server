<?php
	
	// Make sure valid request has been made
	if(empty($_GET['User']) || empty($_POST['Pass']) || empty($_GET['hash']))
	{
		echo "Error, parameters missing";
		exit;
	}
	// Retrieve connection details
	$DBInfo = file_get_contents("../mysql.json");
	$DBInfo = json_decode($DBInfo, true);
	// Connect to server
	$db = mysqli_connect($DBInfo["Host"], $DBInfo["User"], $DBInfo["Pass"], $DBInfo["DB"]); 
	if (mysqli_connect_errno())
	{
		echo "Error connecting to server: " . mysqli_connect_error();
		exit;
	}

	// Strings must be escaped to prevent SQL injection attack. 
	$name = mysqli_real_escape_string($db, $_GET['User']); 
	$pass = mysqli_real_escape_string($db, $_POST['Pass']); 
	$hash = $_GET['hash']; 
	// Shhhhh, it's a secret
	$secretKey = "farmersAreCool";

	// Verify that request was genuine
	$real_hash = md5($name . $pass . $secretKey);
	if($real_hash == $hash) 
	{
		// Fetch data
		$query = "SELECT Id, Password FROM User WHERE Username = '" . $name . "';";
		$result = mysqli_query($db, $query);
		$row_cnt = mysqli_num_rows($result);
		$row = mysqli_fetch_row($result);
		// Invalid credentials
		if($row_cnt == 0 || !password_verify($pass, $row['1']))
		{
			echo "Error username or password is incorrect";
			exit;
		}
		echo "Successfully logged in#";
		echo $row['0'];
		mysqli_free_result($result);
	}
	else
	{
		echo "Error Failed Hash";
	}
	mysqli_close($db);
?>