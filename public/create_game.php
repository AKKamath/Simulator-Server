<?php
	// Exit for invalid attempt
	if(empty($_GET['UserId']))
	{
		echo "-1";
		exit;
	}
	// Get connection details
	$dbInfo = file_get_contents("../mysql.json");
	$dbInfo = json_decode($dbInfo, true);
	// Connect to server
	$db = mysqli_connect($dbInfo["Host"], $dbInfo["User"], $dbInfo["Pass"], $dbInfo["DB"]);
	mysqli_query($db, "UPDATE User SET Currency = 500 WHERE Id = " . $_GET['UserId'] . ";");
	$id = mysqli_real_escape_string($db, $_GET['UserId']);
	mysqli_query($db, "INSERT INTO Tile (UserId, X, Y, Value, Type) VALUES (".$id. ", 1, 1, 1, 0), (".$id. ", -1, 1, 1, 0), (".$id. ", 1, -1, 1, 0), (".$id. ", -1, -1, 1, 0);");
?>