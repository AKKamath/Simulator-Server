<?php
	// Exit for invalid attempt
	if(empty($_GET['UserId']) || empty($_GET['start']) || empty($_GET['complete']) || empty($_GET['update']) || empty($_GET['type']) || empty($_GET['TileId']) || empty($_GET['fail']))
	{
		echo "-1";
		exit;
	}
	// Get connection details
	$dbInfo = file_get_contents("../mysql.json");
	$dbInfo = json_decode($dbInfo, true);
	// Connect to server
	$db = mysqli_connect($dbInfo["Host"], $dbInfo["User"], $dbInfo["Pass"], $dbInfo["DB"]);
	$id = mysqli_real_escape_string($db, $_GET['UserId']);
	mysqli_query($db, "INSERT INTO `Tasks`(`UserId`, `Start_time`, `Completion_time`, `Fail_time`, `Update_time`, `Type`, `TileId`) VALUES (".$id.",'". $_GET['start'] . "', '". $_GET['complete']."','". $_GET['fail'] ."','" .$_GET['update']."',".$_GET['type'].",".$_GET['TileId'].");");
?>