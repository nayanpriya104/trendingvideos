jQuery(document).ready(function(){
	jQuery.get(
		"https://www.googleapis.com/youtube/v3/videos",{
			part: 'snippet,statistics',
			chart: 'mostPopular',
			regionCode: 'IN',
			maxResults: 10,
			vq: 'hd1080',
			key: 'AIzaSyCMoiHY8lMfGWdcRfHqYRz6jCu6ozLOVD8'},
			function(data){
				$.each(data.items, function(i, item){
					var snippet = item.snippet;
					var statistics = item.statistics;
					var cid = snippet.channelId;
					//console.log(item.id);
					$('#video_block').append('<div class="col-sm-4 my-3"><div class="ratio ratio-1x1 text-center"><iframe width="350" height="190" src="https://www.youtube.com/embed/'+item.id+'?rel=0" title="YouTube video"></iframe></div><button class="btn btn-outline-danger detailbtn" id="detail-'+item.id+'">Detail</button></div>');
					jQuery("#detail-"+item.id+"").click(function(){ 
						videoDetail(item.id,snippet, statistics );
						window.location.replace('video.php?video='+item.id);
				    });
						getChannel(cid); 
				});
			});

	function getChannel(cid){
		jQuery.get(
		"https://www.googleapis.com/youtube/v3/channels",{
			id: cid,
			part: 'snippet,statistics',
			key: 'AIzaSyCMoiHY8lMfGWdcRfHqYRz6jCu6ozLOVD8'},
			function(data){
				$.each(data.items, function(i, item){
					$.ajax({
						url: "./partial/channel.php",
						type: "post",
						data: item,
						success: function(response){
							//console.log(response);
						},
						error: function(jqXHR, textStatus, errorThrown) {
			           		console.log(textStatus, errorThrown);
			        	}
					});
				});
			}
		);
	}

	function videoDetail(vid, snippet, statistics){
		$.ajax({
			url: "./partial/api.php",
			type: "post",
			data: {snippet:snippet, statistics:statistics, id:vid},
			success: function(response){
				//console.log(response);
			},
			error: function(jqXHR, textStatus, errorThrown) {
           		console.log(textStatus, errorThrown);
        	}
		});
	}

});
