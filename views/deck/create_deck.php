<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\DeckTags;
/* @var $this yii\web\View */
/* @var $model app\models\Deck */
use dosamigos\fileupload\FileUpload;
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

							<div class="deck-img-pre col-sm-4 col-md-4">
								<?php $form = ActiveForm::begin([
									'id' => 'deck-form',
									]); ?>
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
																
																$(".deck-img-pre").css("background","#f1f1f1 url("+thumbnailUrl+")")
																$(".deck-img-pre").css("background-size", "cover");
																$("#deck-cover_image").val(thumbnailUrl);
															
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
								<?php $form = ActiveForm::begin([
				/* 				'fieldConfig' => [
										'options' => [
											'tag'=>'p',
											'class'=>'desc'
										]
									] */
									
									'id' => 'deck-formcheck',
								]); ?>
								<?= $form->field($model, 'cover_image', 
								[
									'template' => "{input}\n{hint}\n{error}"
								])->hiddenInput() ?>
								<div class="deck-header">
									<h3  class="pull-left">								
										<?= $form->field($model, 'title', [
										'template' => "{input}\n{hint}\n{error}"
										])->textInput(['class'=>'','placeholder'=>'Untitled Deck']) ?>
									</h3>
									<ul class="deck-list pull-right">
										<li><a href=""><img src="<?=\Yii::$app->homeUrl?>images/share_icon.png" alt=""></a></li>
										<li><a href=""><img src="<?=\Yii::$app->homeUrl?>images/bookmark_icon.png" alt=""></a></li>
										<li><a href=""><img src="<?=\Yii::$app->homeUrl?>images/heart_icon.png" alt=""></a></li>
									</ul>
								</div>								

								<div class="form-group">
								<?= $form->field($model, 'description', [
										'template' => "{input}\n{hint}\n{error}"
									])->textArea(['rows' => '3','class'=>'form-control','placeholder'=>'Tell us what this Deck is about']) ?>
								</div>

								<div class="form-group">	
									<select class="js-example-basic-multiple form-control" id="deck-tags" name="tags[]" multiple="multiple" placeholder="Add some tags no working">

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
								</div>
								
								<div class="form-group">
									<?= Html::submitButton( 'Save' , ['class' =>  'btn btn-lg qard']) ?>
								</div>

								<?php ActiveForm::end(); ?>							

							</div>                                        
						</div>
                                   
						
					</div>
					<div class="col-sm-4 col-md-4">
							<div class="sidebar-qard qard-manage" id="preview">     <!-- side qard -->
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
	$(".select2-search__field").attr("placeholder","Add Some Tag");
	$(".select2-search__field").removeAttr("style");
	
/* 	$(".qard-share").on("mouseover",function(){
		console.log("hovered");

	}); */

		$( "#deck-formcheck" ).submit(function( event ) {
				if($( ".select2-selection__rendered" ).find( ".select2-selection__choice" ).length <= 0)
				{
					alert("Please Add Some Tag!!!.");
					return false;
				}
  
		});

		 $(document).ready(function () {
        $("#deck-bg_image").change(function() {
			var loadingUrl = "<?=Yii::$app->request->baseUrl?>/img/loading1.gif";
			$(".deck-img-pre").css("background","#f1f1f1 url("+loadingUrl+")")
			$(".deck-img-pre").css("background-size", "cover");			
			
		});
	 });
	</script>