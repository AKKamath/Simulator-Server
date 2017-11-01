<?php
	// Exit for invalid attempt
	if(empty($_GET['TileId']) || $_GET['TileId'] == 0 || empty($_GET['Harvest']) || empty($_GET['UserId']))
	{
		echo "-1";
		exit;
	}
	// Get connection details
	$dbInfo = file_get_contents("../mysql.json");
	$dbInfo = json_decode($dbInfo, true);
	// Connect to server
	$db = mysqli_connect($dbInfo["Host"], $dbInfo["User"], $dbInfo["Pass"], $dbInfo["DB"]);
	mysqli_query($db, "DELETE FROM Tile WHERE TileId = ". mysqli_real_escape_string($db, $_GET['TileId']) . ";");
	if($_GET['Harvest'] == 1)
		mysqli_query($db, "Update User SET Currency = currency + 100 WHERE Id = " . $_GET['UserId'] . ";");
?>