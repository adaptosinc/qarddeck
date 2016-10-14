<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\DeckTags;
use app\models\Qard;

/* @var $this yii\web\View */
/* @var $model app\models\Deck */
use dosamigos\fileupload\FileUpload;
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Decks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.sidebar-qard {
   margin: 20px 0;
   top: 70px;
   position: fixed;
   width: 30%;
z-index:999;
}
</style>
<link href="<?= Yii::$app->request->baseUrl?>/css/select2.css" rel="stylesheet">
	<section class="manage-deck">
		<div class="main-content">
			<div class="popular-qards">     <!-- popular qard list -->
				<div class="row">                                
					<div class="col-sm-8 col-md-8">
						<div class="row">
					
						 
							<div class="deck-img-pre col-sm-4 col-md-4" <?php if(isset($model->bg_image) && !empty($model->bg_image)){
									echo 'style="background: rgb(241, 241, 241) url('.$model->bg_image.') repeat scroll 0 0 / cover"' ; 	
								} ?> >
								
					<input type="hidden" name='deck-id' id="deck-id" value="<?php echo $model->deck_id; ?>" >
				
									<?php $form = ActiveForm::begin([
									'id' => 'deck-form',
									]); ?>
									
									<?= $form->field($model, 'cover_image', 
								[
									'template' => "{input}\n{hint}\n{error}"
								])->hiddenInput() ?>
								
								<?= FileUpload::widget([
									'model' => $model,
									'attribute' => 'bg_image',
									'url' => ['deck/set-cover-image'], // your url, this is just for demo purposes,
									'options' => ['accept' => 'image/*','class'=>'class'],
									'clientOptions' => [
										'maxFileSize' => 2000000
									],
								
									'clientEvents' => [ 
										'fileuploaddone' => 'function(e, data) {							
																console.log(e);
																console.log(data.result);
																var dat = JSON.parse(data.result);
																thumbnailUrl = dat.files[0].thumbnailUrl;
																console.log(thumbnailUrl);
																var html = "<img width=200px height=200px src="+thumbnailUrl+" />";
																var deckid = $("#deck-id").val();
																$(".deck-img-pre").css("background","#f1f1f1 url("+thumbnailUrl+")")
																$(".deck-img-pre").css("background-size", "cover");
																$("#deck-cover_image").val(thumbnailUrl);
																
			$.ajax({
			url: "'.Url::to(['deck/deck-image'], true).'",
			data: { "deck-id": deckid,"deck-image": thumbnailUrl},
			type: "POST",
			success: function(data) {
					alert("Deck Image Change Successfully!!!.");
				
			}
		});
															}',
										'fileuploadfail' => 'function(e, data) {
																console.log(e);
																console.log(data);
															}',
									],
								]);?>
								<p>click to select file</p>
								<div id="preview">
								</div>
								<?php ActiveForm::end(); ?>	
								
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
							$qards[] = $qardDeck->qard_id;
						}
						
						?>
						<div class="deckgrid">
							<?php foreach($qards as $qard) {
								
								$qardval = 	Qard::find()->where('qard_id = :qard_id and status != :status', ['qard_id'=>$qard, 'status'=>2, 'status'=>9])->one();
								
											if(isset($qardval)){
										?>
							<div class="deckgrid-item">     <!-- qard -->
								<div class="qard-content">
									<div class="qard-share" id="<?=$qardval->qard_id;?>">
										<h4><button class="btn btn-default">View Qard</button></h4>
										<ul>
											<li class="tootip warning" data-title="Remove from deck"><span class="arrow-bottom"></span><i class="fa fa-minus"></i></li>
											<li class="danger"><img src="<?=\Yii::$app->homeUrl?>images/delete_icon_small.png" alt=""></li>                                                        
										</ul>
									</div>
									<img src="<?=\Yii::$app->homeUrl?>uploads/qards/<?=$qardval->qard_id;?>.png" alt="">									
								</div>                                                                                      
							</div>
							<?php } } ?>  

							<div class="deckgrid-item">     <!-- qard -->
								<div class="add-qard">
									<a href="<?=\Yii::$app->homeUrl?>qard/create-deck-qard?deck_id=<?php echo $model->deck_id ?>">
									<img src="<?=\Yii::$app->homeUrl?>images/new-deck_icon.png" alt="">
									<h4>Create New Qard</h4></a>
								</div>
							</div>                                          
						</div>  <!-- row -->                                    
						
					</div>
					<div class="col-sm-4 col-md-4">
							<div class="sidebar-qard qard-manage" id="qardpreview">     <!-- side qard -->
								<div class="qard-content" style="text-align:center !important" >
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
					$("#qardpreview").html(response);	
				}
			});
					
		},
		mouseleave: function () {
			//stuff to do on mouse leave
			var html='<div class="sidebar-qard qard-manage" id="qardpreview"><div class="qard-content" style="text-align:center !important" ><img src="<?=\Yii::$app->homeUrl?>images/preview_icon.png" alt=""><h4>Qard Preview Area</h4></div></div>';
			$("#qardpreview").html(html);
		}
	});
	
	 $(document).ready(function () {
        $("#deck-bg_image").change(function() {
			var loadingUrl = "<?=Yii::$app->request->baseUrl?>/img/loading1.gif";
			$(".deck-img-pre").css("background","#f1f1f1 url("+loadingUrl+")")
			$(".deck-img-pre").css("background-size", "cover");	

				
		});
	 });
	$(window).scroll( function() {
	   if($(this).scrollTop() == 0) {
		   $('.sidebar-qard.qard-manage').css('top','70px');
	   }else{
	$('.sidebar-qard.qard-manage').css('top','0px');
	}
	});	 
			
	</script>