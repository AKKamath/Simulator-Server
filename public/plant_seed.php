<?php
	// Exit for invalid attempt
	if(empty($_GET['UserId']) || empty($_GET['Parent']) || empty($_GET['Type']))
	{
		echo "-1";
		exit;
	}
	// Get connection details
	$dbInfo = file_get_contents("../mysql.json");
	$dbInfo = json_decode($dbInfo, true);
	// Connect to server
	$db = mysqli_connect($dbInfo["Host"], $dbInfo["User"], $dbInfo["Pass"], $dbInfo["DB"]);
	mysqli_query($db, "UPDATE User SET Currency = Currency - 5 WHERE Id = " . $_GET['UserId'] . ";");
	mysqli_query($db, "INSERT INTO Tile (UserId, X, Y, Value, Type, Parent) VALUES (". mysqli_real_escape_string($db, $_GET['UserId']) . ", 0, 0, 1, " . mysqli_real_escape_string($db, $_GET['Type']) .  ", ". mysqli_real_escape_string($db, $_GET['Parent']) . ");");
	$query = "SELECT MAX(TileId) FROM Tile;";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_row($result);
	echo $row['0'];
	mysqli_free_result($result);
?>