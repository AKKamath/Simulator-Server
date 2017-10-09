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
	$result = mysqli_query($db, "SELECT UserId, TileId, X, Y, Value, Type, Parent FROM Tile WHERE UserId = ". mysqli_real_escape_string($db, $_GET['Id']) . ";");
	if(mysqli_num_rows($result) == 0)
		$result = mysqli_query($db, "SELECT UserId, TileId, X, Y, Value, Type, Parent FROM Tile WHERE UserId = -1;");
	if (mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		while($row = mysqli_fetch_row($result)) 
		{
			foreach($row as $r)
				echo $r . " ";
			echo "\n";
		}
	}
	else
		echo "-1";
?>