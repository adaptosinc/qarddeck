<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Deck */
use app\models\Qard;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Decks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;




?>
<div class="deck-view">

<style>
.grid-item { width: 350px; }
</style>

<script src="<?= Yii::$app->request->baseUrl?>/js/masonry.js" type="text/javascript"></script>	
<script src="<?= Yii::$app->request->baseUrl?>/js/imagesloaded.js" type="text/javascript"></script>	

<section class="deck-details main-stream">
                    <div class="deck-header" style="display: block;">
                        <div class="row">
                            <div class="col-sm-8 col-md-8">
                                <div class="col-sm-4 col-md-4">
                                    <img src="<?=$model->bg_image?>" style="width:100%; background-size:cover" alt="">
                                </div>
                                <div class="user-details col-sm-8 col-md-8">
                                    <h3><?=$model->title?></h3>
                                    <p><?=$model->description?></p>
                                    <ul class="deck-tags">
									<?=$model->getTagsHtml();?>
                                    </ul>
									<?php if(Yii::$app->user->id == $model->user_id){ ?>
										<span class="pull-right"><button class="btn btn-grey" onclick="location.href='<?=\Yii::$app->homeUrl?>deck/manage?id=<?=$model->deck_id?>';"><i class="fa fa-pencil"></i>&nbsp;Edit Deck</button>
										<button class="btn btn-grey deck-delete" data-id="<?=$model->deck_id?>" ><i class="fa fa-trash"></i>&nbsp;Delete Deck</button></span>
									<?php } ?>
                                </div>
                            </div>
                            <div class="right-block col-sm-4 col-md-4">
                                <ul class="deck-list">
                                    <li><a href=""><img src="<?= \Yii::$app->homeUrl?>images/share_icon.png" alt=""></a><span><?=$count_share;?></span></li>
                                    <li><a href=""><img src="<?= \Yii::$app->homeUrl?>images/bookmark_icon.png" alt=""></a><span><?=$count_bookmark;?></span></li>
                                    <li><a href=""><img src="<?= \Yii::$app->homeUrl?>images/heart_icon.png" alt=""></a><span><?=$count_liked;?></span></li>
                                </ul>
                                <div class="user-info">
								
                                    <img src="<?=$model->userProfile->profile_photo?>" alt="" width="50px" height="50px" style="border-radius: 50%;display: inline-block;"><strong><?=$model->userProfile->fullname?><br><span><?=$model->getDeckCreatedAgo();?></span></strong>
                                    
									<?php if(($follow!=2) && (\Yii::$app->user->id != $model->user_id)){?>
									
									<button id='follow' <?php if($follow == 1){ echo "style='display:none'"; } ?>name="follow" class="btn btn-grey followopt" ><i class="fa fa-user-plus"></i>&nbsp;Follow</button>
							<button id='following' <?php if( $follow == 0) { echo "style='display:none'"; } ?> name="following" class="btn btn-grey followopt" >&nbsp;Unfollow </button> 
									<?php } ?>
                                </div>
                                <button id="changetoslider" class="btn qard">View Deck as Slides</button>
                            </div>
                        </div>
                    </div>                  
					<?php 
					$qardDecks = $model->qardDecks;				
						
					$qards = [];												
					foreach($qardDecks as $qardDeck){
						$qards[] = $qardDeck->qard_id;								
					}
					
					
					?>
               
					
					  <div class="main-content" id="generalview" >
                        <div class="popular-qards profile tab-pane fade in active" role="tabpanel"  id="tab1">     <!-- popular qard list -->
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 350, "gutter": 40 }' >	
										<?php foreach($qards as $qard) {
								if(\Yii::$app->user->id == $model->user_id)
								{								
								$qardval = 	Qard::find()->where('qard_id = :qard_id', ['qard_id'=>$qard])->andwhere(['Not in', 'status', [2,9]])->one();
								} else 
								{	
									$qardval = 	Qard::find()->where('qard_id = :qard_id and status = :status', ['qard_id'=>$qard, 'status'=>1])->one();
								}
								
					
											if(isset($qardval)){
																							
										?>
										<?php print_r($qardval->getQardHtml()); ?>
										
										<?php } 
											} ?>  
											
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
	
	<div class="container" id="sliderview"  style="display:none;" >
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false" data-wrap="false" >
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
	
	
                        
									
	  	<?php 
					$i = 0;
				foreach($qards as $qard) {								
				/* 		$qardval = 	Qard::find()->where('qard_id = :qard_id and status != :status', ['qard_id'=>$qard, 'status'=>2])->one(); */
					
					if(\Yii::$app->user->id == $model->user_id)
								{									
								$qardval = 	Qard::find()->where('qard_id = :qard_id and status != :status', ['qard_id'=>$qard, 'status'=>2,'status'=>9])->one();
								} else 
								{
									$qardval = 	Qard::find()->where('qard_id = :qard_id and status = :status', ['qard_id'=>$qard, 'status'=>1])->one();
								}
								
				if(isset($qardval)){
																							
						?>
						
		  
					<div class="item <?php if($i == 0){ echo "active"; } ?>" >	
					
					<div class="main-content" style="margin-left:25%" >
			<div class="popular-qards profile tab-pane fade in active" role="tabpanel">  
		  
					<?php print_r($qardval->getQardHtml()); ?>
					
					
						</div>
						
						</div>
    </div>	
					<?php $i= $i+1; } 
								} ?> 
											
			 
   
    							
   
    </div>

    <!-- Left and right controls -->
	<?php if($i > 1) { ?>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" style="color: black;" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" style="color: black;" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
	<?php } ?>
  </div>
</div>


	<!-------------------------- Slider Function End -------------------------------->
	
                </section>

</div>
<script>
	$('.qard-content').on('click',function(){
		var data_id = $(this).attr('id');
		var id = data_id.replace("qard", "");
		var url = '<?=Url::to(['qard/consume'], true);?>';
		window.location.href = url+"?qard_id="+id;
	});
	
	$('.followopt').on('click',function(){
					var id = $(this).attr("id");
					var userid = <?php echo $checkuserid = (isset(Yii::$app->user->id) && !empty(Yii::$app->user->id)) ? Yii::$app->user->id :"0";  ?>;
					var followuserid = <?=$model->user_id?>;
					
				if(($.trim(userid) != "" ) && ($.trim(userid) != "0" )  && ($.trim(followuserid) != ""))
				{
					if(id=="follow")
					{
						$.ajax({
						url: '<?=Url::to(['qard/followuser'], true);?>',
						type: "POST",
						data: {
							'userid': userid,'followuserid':followuserid 
						},
						success: function(data) {							
							$("#"+id).hide();
							$("#following").show();
						}
					});
					
						
					}
					else if(id=="following")
					{
						$.ajax({
						url: '<?=Url::to(['qard/unfollowuser'], true);?>',
						type: "POST",
						data: {
							'userid': userid,'followuserid':followuserid 
						},
						success: function(data) {
							$("#"+id).hide();
							$("#follow").show();
							}
						});
					
					}
				}
			});
			
			
	$('.deck-delete').on('click',function(){
		var chksts = confirm ("Are you sure to delete this Deck ?");
		if(chksts == true)	
		{
				var deckid = $(this).attr('data-id');
				$.ajax({
						url: '<?=Url::to(['deck/delete-deck'], true);?>',
						type: "POST",
						data: {
							'deckid': deckid
						},
						success: function(data) {
							alert("Deck has been Deleted Successfully!!!.");							
							window.location.href = "<?=\Yii::$app->homeUrl?>qard/my-qards?type=decks";
							}
						});						
		}
	});
	
	$('#changetoslider').on('click',function(){
		var chaval = $("#changetoslider").html();
			if($.trim(chaval) == "View Deck as Slides")
				$("#changetoslider").html("View Deck as General");
			else if($.trim(chaval) == "View Deck as General")
				$("#changetoslider").html("View Deck as Slides");
			
		$("#sliderview").toggle();
		$("#generalview").toggle();
		
	});
	
	

	$( document ).ready(function() {
		checkitem() ;
		$('#myCarousel').on('slid.bs.carousel', checkitem);
	});
	
function checkitem()                        // check function
{
   var $this = $('#myCarousel');
  $this.children('.carousel-control').show();

  if($('.carousel-inner .item:first').hasClass('active')) {
    $this.children('.left.carousel-control').hide();
  } else if($('.carousel-inner .item:last').hasClass('active')) {
    $this.children('.right.carousel-control').hide();
  }
 
}



	

</script>

