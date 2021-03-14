<?php include('partial/_header.php'); ?>
<?php include('partial/_dbconnect.php'); ?>

<?php 
if(isset($_GET['video'])){
	$vid = $_GET['video'];
	$sql = "SELECT * from video WHERE `video_id`= '$vid'";
	$result = mysqli_query($conn, $sql);
	$video_row = mysqli_fetch_assoc($result);
	$url = "https://www.youtube.com/embed/".$vid."?autoplay=1";
	$channelId = $video_row['channelId'];
	$sql2 = "SELECT * from channel WHERE `channelId`= '$channelId'";
	$result2 = mysqli_query($conn, $sql2);
	$channel_row = mysqli_fetch_assoc($result2);

}
?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
        	<div class="ratio ratio-1x1">
        		<iframe width="1110" height="420" title='YouTube video' src=<?php echo "$url";?>>
        		</iframe>
        	</div>
        </div>
        <div class="col-12">
        	<table class="table table-sm table-dark">
  				<thead>
  					<tr>
			    		<th>Channel</th>
			    	</tr>
			  	</thead>
			  	<tbody>
			  		<?php foreach($channel_row as $key=>$value){
			  			$key_array = ['id','channelId','insertedAt','updatedAt'];
			  			if(!in_array($key, $key_array)){?>
			  			<tr>
			    			<td><?php echo $key; ?></td>
			    			<td><?php echo $value; ?></td>
			    		</tr>
			  		<?php } } ?>
			  </tbody>
			</table>
			<table class="table table-sm table-dark">
  				<thead>
  					<tr>
			    		<th>Video</th>
			    	</tr>
			  	</thead>
			  	<tbody>
			  		<?php foreach($video_row as $key=>$value){
			  			$key_array = ['id','video_id','channelId','insertedAt','updatedAt'];
			  			if(!in_array($key, $key_array)){?>
			  			<tr>
			    			<td><?php echo $key; ?></td>
			    			<td><?php echo $value; ?></td>
			    		</tr>
			  		<?php } } ?>
			  </tbody>
			</table>
        </div>
    </div>
</div>

<?php include('partial/_footer.php'); ?>