<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\DeckTags;
/* @var $this yii\web\View */
/* @var $model app\models\Deck */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Decks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="<?= Yii::$app->request->baseUrl?>/css/select2.css" rel="stylesheet">
	<section class="manage-deck">
		<div class="main-content">
			<div class="popular-qards">     <!-- popular qard list -->
				<div class="row">                                
					<div class="col-sm-8 col-md-8">
						<div class="row">
							<div class="col-sm-4 col-md-4">
								<img src="<?=$model->bg_image?>" style="width:100%; background-size:cover" alt="">
							</div>
							<div class="col-sm-8 col-md-8">
							<form name="ajaxDeck" id="ajaxDeck" onChange="saveDeck()">
								<div class="deck-header">
									<h3  class="pull-left"><input type="text" value="<?=$model->title?>" name="title" /> </h3>
									<ul class="deck-list pull-right">
										<li><a href=""><img src="<?=\Yii::$app->homeUrl?>images/share_icon.png" alt=""></a></li>
										<li><a href=""><img src="<?=\Yii::$app->homeUrl?>images/bookmark_icon.png" alt=""></a></li>
										<li><a href=""><img src="<?=\Yii::$app->homeUrl?>images/heart_icon.png" alt=""></a></li>
									</ul>
								</div>
								<div class="form-group">
									<textarea name="description" class="form-control" placeholder="Tell us what this Deck is about" onChange="saveDeck()"><?=$model->description?></textarea>
								</div>
								<div class="form-group">
		
									<select class="js-example-basic-multiple form-control" id="deck-tags" name="tags[]" multiple="multiple" onChange="saveDeck()">

									<?php 
									if(!$model->isNewRecord){
										$selected_tags = [];
										$saved_tags = DeckTags::find()->where(['deck_id'=>$model->deck_id])->all();
										foreach($saved_tags as $saved_tag){
											$selected_tags[$saved_tag->tag_id] = $saved_tag->tag_id;
										}
										//print_r($selected_tags);exit;
										foreach($tags as $tag){
											if(array_key_exists($tag->tag_id,$selected_tags))
												echo '<option value="'.$tag->tag_id.'" selected>'.$tag->name.'</option>';
											else
												echo '<option value="'.$tag->tag_id.'">'.$tag->name.'</option>';
										}						
									}
									else
									{
										foreach($tags as $tag){
											echo '<option value="'.$tag->tag_id.'">'.$tag->name.'</option>';
										}						
									}					

									?>
									</select>

									<span class="pull-right"><i>Your changes will be automatically saved!</i></span>
								</div>
								</form>
							</div>                                        
						</div>
						<?php 
						//fetch qards of the screen
						$qardDecks = $model->qardDecks;
						$qards = [];
						foreach($qardDecks as $qardDeck){
							$qards[] = $qardDeck->qard;
						}						
						?>
						<div class="deckgrid">
							<?php foreach($qards as $qard) {
											if(isset($qard)){
										?>
							<div class="deckgrid-item">     <!-- qard -->
								<div class="qard-content">
									<div class="qard-share" id="<?=$qard->qard_id;?>">
										<h4><button class="btn btn-default">View Qard</button></h4>
										<ul>
											<li class="tootip warning" data-title="Remove from deck"><span class="arrow-bottom"></span><i class="fa fa-minus"></i></li>
											<li class="danger"><img src="<?=\Yii::$app->homeUrl?>images/delete_icon_small.png" alt=""></li>                                                        
										</ul>
									</div>
									<img src="<?=\Yii::$app->homeUrl?>uploads/qards/<?=$qard->qard_id;?>.png" alt="">									
								</div>                                                                                      
							</div>
							<?php }} ?>  

							<div class="deckgrid-item">     <!-- qard -->
								<div class="add-qard">
									<img src="<?=\Yii::$app->homeUrl?>images/new-deck_icon.png" alt="">
									<h4>Create New Qard</h4>
								</div>
							</div>                                          
						</div>  <!-- row -->                                    
						
					</div>
					<div class="col-sm-4 col-md-4">
							<div class="sidebar-qard qard-manage" id="preview">     <!-- side qard -->
								<div class="qard-content">
									<img src="<?=\Yii::$app->homeUrl?>images/preview_icon.png" alt="">
									<h4>Qard Preview Area</h4>
								</div>                                                                                  
							</div>                                     
					</div>                                

				</div>          <!-- row -->
			</div>
		</div>
	</section>
	<script src="<?= Yii::$app->request->baseUrl?>/js/select2.js" type="text/javascript"></script>
	<script>
	$(".js-example-basic-multiple").select2();
	
	if($( ".select2-selection__rendered" ).find( ".select2-selection__choice" ).length <= 0)
	{
		$(".select2-search__field").attr("placeholder","Add Some Tag");
		$(".select2-search__field").removeAttr("style");		
	}
	
	$(document).on('click', '.select2-selection__choice__remove', function(){ 
		if($( ".select2-selection__rendered" ).find( ".select2-selection__choice" ).length <= 0)
		{
			$(".select2-search__field").attr("placeholder","Add Some Tag");	
			$(".select2-search__field").removeAttr("style");			
		} else{
			$(".select2-search__field").removeAttr("placeholder");		
		}
	 
	});
	
	
	/* $(".select2-search__field").attr("placeholder","Add Some Tag");
	$(".select2-search__field").removeAttr("style"); */
	
	function saveDeck(){
		//console.log("saved");
		var $form = $("#ajaxDeck");
		var method = $form.attr("method") ? $form.attr("method").toUpperCase() : "POST";
		$.ajax({
			url: "<?=Url::to(['deck/manage','id'=>$model->deck_id], true);?>",
			data: $form.serialize(),
			type: method,
			success: function() {
				// do stuff with the result, if you want to 
			}
		});
	}
/* 	$(".qard-share").on("mouseover",function(){
		console.log("hovered");

	}); */
	$(".qard-share").on({
		mouseenter: function () {
			//stuff to do on mouse enter
			var id = $(this).attr('id');
			$.ajax({
				url: "<?=Url::to(['qard/view'], true);?>"+'?id='+id,
				type: "GET",
				success: function(response) {
					// do stuff with the result, if you want to 
					$("#preview").html(response);	
				}
			});
					
		},
		mouseleave: function () {
			//stuff to do on mouse leave
			var html='<div class="sidebar-qard qard-manage" id="preview"><div class="qard-content"><img src="<?=\Yii::$app->homeUrl?>images/preview_icon.png" alt=""><h4>Qard Preview Area</h4></div></div>';
			$("#preview").html(html);
		}
	});
	</script>