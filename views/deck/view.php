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

<section class="deck-details">
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
                                <button class="btn qard">View Deck as Slides</button>
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
                    <div class="main-content">
                        <div class="popular-qards">     <!-- popular qard list -->
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="deckgrid">
										<?php foreach($qards as $qard) {										
											$qardval = 	Qard::findOne($qard);
											if(isset($qard)){
										?>
											<div class="deckgrid-item">     <!-- qard -->
												<div class="qard-content">
													<?php print_r($qardval->getQardHtmlSingle()); ?>
												</div>
												<div class="qard-bottom">
													<ul class="qard-tags">
														<li class="pull-left"><img src="<?=$qardval->userProfile->profile_photo; ?>" alt="" width="15px" height="15px" style="border-radius:50%;"><?=$qardval->userProfile->fullname; ?></li>
														<li class="pull-right"><?=$qardval->getCreatedAgo();?></li>
													</ul>
													<h4><?=$qardval->title; ?></h4>
												</div>                                              
											</div>										
											<?php }} ?>                                      
                                    </div>  <!-- row -->
                                </div>
                            </div>          <!-- row -->
                        </div>
                    </div>
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
			
</script>