<?php
	// Exit for invalid attempt
	if(empty($_GET['TileId']) || $_GET['TileId'] == 0 || empty($_GET['Value']))
	{
		echo "-1";
		exit;
	}
	// Get connection details
	$dbInfo = file_get_contents("../mysql.json");
	$dbInfo = json_decode($dbInfo, true);
	// Connect to server
	$db = mysqli_connect($dbInfo["Host"], $dbInfo["User"], $dbInfo["Pass"], $dbInfo["DB"]);
	mysqli_query($db, "UPDATE Tile SET Value = ". mysqli_real_escape_string($db, $_GET['Value']) . " WHERE TileId = ". mysqli_real_escape_string($db, $_GET['TileId']) . ";");
?>