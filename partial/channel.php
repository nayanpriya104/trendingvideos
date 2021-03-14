<?php 
include('_dbconnect.php');

if (isset($_POST)) {
	$snippet = $_POST['snippet'];
	$statistics = $_POST['statistics'];
	$channelId = $_POST['id'];
	$channelTitle = str_replace("'", "",$snippet['title']);
	$channelDesp = str_replace("'", "", $snippet['description']);
	$thumb_default = $snippet['thumbnails']['default']['url'];
	$thumb_medium = $snippet['thumbnails']['medium']['url'];
	$thumb_high = $snippet['thumbnails']['high']['url'];
	$subscriberCount = $statistics['subscriberCount'];

	$sql = "SELECT * from `channel` WHERE `channelId`= '$channelId'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result);

	if($row[1] != $channelId){
		$sql = "INSERT INTO `channel`(`channelId`, `title`, `description`, `subscribersCount`,
				`thumbDefault`, `thumbMedium`, `thumbHigh`) VALUES ('$channelId', '$channelTitle',
				'$channelDesp', '$subscriberCount', '$thumb_default', '$thumb_medium', '$thumb_high')";

		$result = mysqli_query($conn, $sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error());
		}
	}
	else if($row[1] == $channelId){
		$sql = "UPDATE `channel` SET `subscribersCount`='$subscriberCount' WHERE `channelId`= '$channelId'";
		$result = mysqli_query($conn, $sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error());
		}

	}	
}

?>