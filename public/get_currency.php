<?php
	// Exit for invalid attempt
	if(empty($_GET['Id']))
	{
		echo "-1";
		exit;
	}
	// Get connection details
	$dbInfo = file_get_contents("../mysql.json");
	$dbInfo = json_decode($dbInfo, true);
	// Connect to server
	$db = mysqli_connect($dbInfo["Host"], $dbInfo["User"], $dbInfo["Pass"], $dbInfo["DB"]);
	$result = mysqli_query($db, "SELECT Currency FROM User WHERE Id = ". mysqli_real_escape_string($db, $_GET['Id']) . ";");
	if(mysqli_num_rows($result) == 1)
	{
		$row = mysqli_fetch_row($result);
		echo $row['0'];
		mysqli_free_result($result);
	}
	else
		echo "-1";
?>