<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Deck */

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
                                    <li><a href=""><img src="<?= \Yii::$app->homeUrl?>images/share_icon.png" alt=""></a><span>11520</span></li>
                                    <li><a href=""><img src="<?= \Yii::$app->homeUrl?>images/bookmark_icon.png" alt=""></a><span>222</span></li>
                                    <li><a href=""><img src="<?= \Yii::$app->homeUrl?>images/heart_icon.png" alt=""></a><span>444</span></li>
                                </ul>
                                <div class="user-info">
                                    <img src="<?= \Yii::$app->homeUrl?>images/deck-thumb.png" alt="" width="50px" height="50px" style="border-radius: 50%;display: inline-block;"><strong><?=$model->userProfile->fullname?><br><span>3 days ago</span></strong>
                                    
                                </div>
                                <button class="btn qard">View Deck as Slides</button>
                            </div>
                        </div>
                    </div>
                    <div class="deck-header fixed" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="col-sm-2 col-md-2">
                                    <img src="<?= \Yii::$app->homeUrl?>images/deck-thumb.png" alt="">
                                </div>
                                <div class="user-details col-sm-10 col-md-10">
                                    <h3><?=$model->title?> <span class="deck-count"><img src="<?= \Yii::$app->homeUrl?>images/qards_icon.png" alt="">&nbsp; 20</span></h3>
                                </div>
                            </div>
                            <div class="right-block col-sm-6 col-md-6">
                                <ul class="deck-list">
                                    <li><a href=""><img src="<?= \Yii::$app->homeUrl?>images/share_icon.png" alt=""></a><span>11520</span></li>
                                    <li><a href=""><img src="<?= \Yii::$app->homeUrl?>images/bookmark_icon.png" alt=""></a><span>222</span></li>
                                    <li><a href=""><img src="<?= \Yii::$app->homeUrl?>images/heart_icon.png" alt=""></a><span>444</span></li>
                                </ul>
                                <button class="btn qard">View Deck as Slides</button>
                            </div>
                        </div>
                    </div>  
					<?php 
					$qardDecks = $model->qardDecks;
					$qards = [];
					foreach($qardDecks as $qardDeck){
						$qards[] = $qardDeck->qard;
					}
					//print_r($qards);
					?>
                    <div class="main-content">
                        <div class="popular-qards">     <!-- popular qard list -->
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="deckgrid">
										<?php foreach($qards as $qard) {
											if(isset($qard)){
										?>
											<div class="deckgrid-item">     <!-- qard -->
												<div class="qard-content">
													<?php 
													
													print_r($qard->getQardHtmlSingle());?>
												</div>
												<div class="qard-bottom">
													<ul class="qard-tags">
														<li class="pull-left"><img src="<?= \Yii::$app->homeUrl?>images/deck-thumb.png" alt="" width="15px" height="15px" style="border-radius:50%;"><?=$model->userProfile->fullname; ?></li>
														<li class="pull-right">3 days ago</li>
													</ul>
													<h4><?=$qard->title; ?></h4>
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
</script>