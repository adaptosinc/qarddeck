<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
    <?php 
	$all_class = $qard_class = $deck_class= '';
	if($type =="both")
		$all_class = 'active';
	if($type =="qards")
		$qard_class = 'active';	
	if($type =="decks")
		$deck_class = 'active';	
	?>             
                <section class="main-stream">
                    <div id="tabs">
                    <div class="stream-cat">
                        <ul class="profile-title nav nav-tabs" role="tablist">
							
                            <li role="presentation" class="<?=$all_class ?>"><h4><a href="<?=Yii::$app->homeUrl?>qard/index?type=both">All</a></h4></li>
                            <li role="presentation" class="<?=$qard_class ?>"><h4><a href="<?=Yii::$app->homeUrl?>qard/index?type=qards" >Qards</a></h4></li>
                            <li role="presentation" class="<?=$deck_class ?>"><h4><a href="<?=Yii::$app->homeUrl?>qard/index?type=decks" >Deck</a></h4></li>
                        </ul>
                    </div>
                    <div class="main-content">
                        <div class="popular-qards profile tab-pane fade in active" role="tabpanel"  id="tab1">     <!-- popular qard list -->
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="grid row">	
										<?php  
											echo $feed;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

<p id="loading" align="center" >
	<img src="<?php echo \Yii::$app->homeUrl; ?>images/loading.gif" width="100px" height="100px" alt="Loading…" />
</p>
<script>
/* $('#save').on('click',function(){
	var dataUrl = document.getElementById('save').toDataURL("image/png");
	console.log(dataUrl);
    html2canvas([document.getElementById('save')], {
		onrendered: function (canvas) {
		//document.getElementById('canvas').appendChild(canvas);
		var data = canvas.toDataURL('image/png');

		$.ajax({
		   url: "<?=Url::to(['qard/save-blob'], true);?>",
		   type: "POST",
		   data: { 
			 'img': data
		   },
		//   processData: false,
		 //  contentType: false,
		}).done(function(respond){
				console.log(respond);
			//$("#save").html("Uploaded Canvas image link: <a href="+respond+">"+respond+"</a>").hide().fadeIn("fast");
		});

	  }
	});
	
}); */
$(document).ready(function() {
	var win = $(window);
	var page = 1;
	// Each time the user scrolls
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
			$('#loading').show();
			$.ajax({
				url: '<?=Url::to(['qard/index'], true);?>',
				dataType: 'html',
				data: {'page':page,'type':'<?=$type?>'},
				success: function(html) {
					console.log(page);
					$('.grid').append(html);
					$('#loading').hide();
				}
			});
			page = page+1;
		}
	});
	$('.social-list li a').on('click',function(){
		console.log($(this).attr('act-type'));
			$.ajax({
				url: '<?=Url::to(['qard/activity'], true);?>',
				dataType: 'html',
				type : 'GET',
				data: {'id':$(this).attr('act-id'),'type':$(this).attr('act-type')},
				success: function(response) {
					console.log(response);
				}
			});
	});
	$('.qard-content').on('click',function(){
		var data_id = $(this).attr('id');
		var id = data_id.replace("qard", "");
		var url = '<?=Url::to(['qard/consume'], true);?>';
		window.location.href = url+"?qard_id="+id;
	});
});

</script>