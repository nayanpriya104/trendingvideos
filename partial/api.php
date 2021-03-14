<?php
include('_dbconnect.php');

if (isset($_POST)) {
	$snippet = $_POST['snippet'];
	$statistics = $_POST['statistics'];
	$channelId = $snippet['channelId'];
	$channelTitle = $snippet['channelTitle'];
	$video_id = $_POST['id'];
	$video_url = "https://www.youtube.com/watch?v=".$video_id;
	$video_title = str_replace("'", "",$snippet['title']);
	$video_desp = str_replace("'", "", $snippet['description']);
	$thumb_default = $snippet['thumbnails']['default']['url'];
	$thumb_medium = $snippet['thumbnails']['medium']['url'];
	$thumb_high = $snippet['thumbnails']['high']['url'];
	$thumb_standard = $snippet['thumbnails']['standard']['url'];
	$thumb_maxres = $snippet['thumbnails']['maxres']['url'];
	$views = $statistics['viewCount'];
	$likes = $statistics['likeCount'];
	$dislike = $statistics['dislikeCount'];

	$sql = "SELECT * from `video` WHERE `video_id`= '$video_id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_row($result);

	if($row[1] != $video_id){
		$sql = "INSERT INTO `video`(`video_id`, `title`, `description`, `url`, `thumbnails_default`, `thumbnails_medium`, `thumbnails_high`, `thumbnails_standard`, `thumbnails_maxres`, `viewCount`, `likeCount`, `dislikeCount`, `channelId`) VALUES ('$video_id', '$video_title', '$video_desp', '$video_url', '$thumb_default', '$thumb_medium', '$thumb_high', '$thumb_standard', '$thumb_maxres', $views, $likes, $dislike, '$channelId')";

		$result = mysqli_query($conn, $sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error());
		}
	}
	else if($row[1] == $video_id){
		$sql = "UPDATE `video` SET `viewCount`=$views,`likeCount`=$likes,`dislikeCount`=$dislike WHERE `video_id`='$video_id'";
		$result = mysqli_query($conn, $sql);
		if (!$result) {
		    die('Invalid query: ' . mysqli_error());
		}
	}
}

?>