<?php
	// Exit for invalid attempt
	if(empty($_GET['TileId']) || empty($_GET['update']) || empty('UserId'))
	{
		echo "-1";
		exit;
	}
	// Get connection details
	$dbInfo = file_get_contents("../mysql.json");
	$dbInfo = json_decode($dbInfo, true);
	// Connect to server
	$db = mysqli_connect($dbInfo["Host"], $dbInfo["User"], $dbInfo["Pass"], $dbInfo["DB"]);
	$result = mysqli_query($db, "SELECT * FROM Tasks WHERE TileId = " . $_GET['TileId'] . ";");
	if (mysqli_num_rows($result) == 0)
	{
		mysqli_query($db, "INSERT INTO `Tasks`(`UserId`, `Start_time`, `Completion_time`, `Fail_time`, `Update_time`, `Type`, `TileId`) VALUES (".$_GET['UserId'].",'". $_GET['update'] . "', '". $_GET['update']."','". $_GET['update'] ."','" .$_GET['update']."',1,".$_GET['TileId'].");");
	}
	else
	{
		if(empty($_GET['fail']))
			mysqli_query($db, "UPDATE Tasks SET Update_time = '". $_GET['update'] ."' WHERE TileId = " . $_GET['TileId'] . ";");
		else
			mysqli_query($db, "UPDATE Tasks SET Update_time = '". $_GET['update'] ."' AND Fail_time = '" . $_GET['fail'] . "' WHERE TileId = " . $_GET['TileId'] . ";");
	}
?>