<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<style>
.grid-item { width: 350px; }
</style>
    <?php 
	$all_class = $qard_class = $deck_class= 'btn-default';
	if($type =="both")
		$all_class = 'qard'; 
	if($type =="qards")
		$qard_class = 'qard';
	if($type =="decks")
		$deck_class = 'qard';	
	?>
    <script src="<?= Yii::$app->request->baseUrl?>/js/masonry.js" type="text/javascript"></script>	
				<div class="profile-header">
					<div class="col-sm-6 col-md-6">
						<div class="user-details">
							<div class="col-sm-2 col-md-2">
								<img src="<?=\Yii::$app->user->identity->profile_photo?>" width="80px" height="80px" style="border-radius: 50%;" alt="">
							</div>
							<div class="col-sm-10 col-md-10">
								<h4><?=\Yii::$app->user->identity->firstname?></h4>
								<ul>
									<li><a href="">@<?=\Yii::$app->user->identity->username?></a></li>
									<li><a href=""><i class="fa fa-envelope"></i>&nbsp;<?=\Yii::$app->user->identity->showEmail?></a></li>
									<li><a href=""><i class="fa fa-chain"></i>&nbsp;<?=\Yii::$app->user->identity->website?></a></li>
								</ul>
							</div>
							<p><?=\Yii::$app->user->identity->bio?></p>
						</div>
					</div>
					<div class="col-sm-3 col-md-3">
						<ul class="view-list">
							<li class="edit-info"><button class="btn btn-grey" onclick="location.href='<?=Yii::$app->homeUrl?>user/profile';"><i class="fa fa-pencil"></i>Edit info</button></li>
							<li>117 Following</li>
							<li>23 Followers</li>
						</ul>
					</div>
					<div class="profile-action col-sm-3 col-md-3">
						<button class="btn btn-lg <?=$all_class ?>" onclick="location.href='<?=Yii::$app->homeUrl?>qard/my-qards?type=both';">Wall</button>
						<button class="btn btn-lg <?=$qard_class ?>" onclick="location.href='<?=Yii::$app->homeUrl?>qard/my-qards?type=qards';">Qards</button>
						<button class="btn btn-lg <?=$deck_class ?>" onclick="location.href='<?=Yii::$app->homeUrl?>qard/my-qards?type=decks';">Decks</button>
					</div>                        
				</div>
				<div class="stream-cat">
					<ul class="profile-title">
						<li class="tootip" data-title="Created by me"><span class="arrow-up"></span><h4><img src="<?=Yii::$app->homeUrl?>images/newqard.png" alt="" width="20px" height="20px">0</h4></li>
						<li><h4><img src="<?=Yii::$app->homeUrl?>images/heart_icon.png" alt="" width="20px" height="20px">0</h4></li>
						<li><h4><img src="<?=Yii::$app->homeUrl?>images/bookmark_icon.png" alt="" width="15px" height="20px">0</h4></li>
						<li><h4><img src="<?=Yii::$app->homeUrl?>images/share_icon.png" alt="" width="20px" height="20px">0</h4></li>
					</ul>
				</div>
                <section class="main-stream">
                    <div id="tabs">
                    <!--<div class="stream-cat">
                        <ul class="profile-title nav nav-tabs" role="tablist">
							
                            <li role="presentation" class="<?=$all_class ?>"><h4><a href="<?=Yii::$app->homeUrl?>qard/my-qards?type=both">All</a></h4></li>
                            <li role="presentation" class="<?=$qard_class ?>"><h4><a href="<?=Yii::$app->homeUrl?>qard/my-qards?type=qards" >Qards</a></h4></li>
                            <li role="presentation" class="<?=$deck_class ?>"><h4><a href="<?=Yii::$app->homeUrl?>qard/my-qards?type=decks" >Deck</a></h4></li>
                        </ul>
                    </div>-->
                    <div class="main-content">
                        <div class="popular-qards profile tab-pane fade in active" role="tabpanel"  id="tab1">     <!-- popular qard list -->
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 350, "gutter": 45 }'>	
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

$(document).ready(function() {
	var win = $(window);
	var page = 1;
	// Each time the user scrolls
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
			$('#loading').show();
			$.ajax({
				url: '<?=Url::to(['qard/my-qards'], true);?>',
				dataType: 'html',
				data: {'page':page,'type':'<?=$type?>'},
				success: function(html) {
					var el = jQuery(html);
					$(".grid").append(el).masonry( 'appended', el, true );
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
});
$(document).on('click','.qard-content',function(){
	var data_id = $(this).attr('id');
	var id = data_id.replace("qard", "");
	var url = '<?=Url::to(['qard/consume'], true);?>';
	window.location.href = url+"?qard_id="+id;
});
</script>