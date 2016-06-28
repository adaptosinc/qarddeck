<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\DeckTags;
/* @var $this yii\web\View */
/* @var $model app\models\Deck */
/* @var $form yii\widgets\ActiveForm */

use dosamigos\fileupload\FileUpload;
$model->bg_image = "null.png";
?>
<link href="<?= Yii::$app->request->baseUrl?>/css/select2.css" rel="stylesheet">
	<ul class="deck-create">
		<li>
			<button class="btn btn-default qard" data-toggle="modal" data-target="#myModaledit">Cancel</button>
		</li>
		<li>
			<div class="deck-manage">

				<?php $form = ActiveForm::begin([
/* 				'fieldConfig' => [
                        'options' => [
                            'tag'=>'p',
							'class'=>'desc'
                        ]
					] */
				]); ?>
				<?= $form->field($model, 'cover_image', 
				[
					'template' => "{input}\n{hint}\n{error}"
				])->hiddenInput() ?>
				
				<?= $form->field($model, 'title', 
				[
					'template' => "{input}\n{hint}\n{error}"
				])->textInput(['class'=>'','placeholder'=>'Untitled Deck']) ?>

				<?= $form->field($model, 'description', [
						'template' => "{input}\n{hint}\n{error}"
					])->textInput(['class'=>'','placeholder'=>'Tell us what this Deck is about']) ?>
					
				<div class="form-group">	
					<select class="js-example-basic-multiple form-control" id="deck-tags" name="tags[]" multiple="multiple">

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
					<?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>

				<?php ActiveForm::end(); ?>

			</div>                            
		</li>

		<li>
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
				// Also, you can specify jQuery-File-Upload events
				// see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
				'clientEvents' => [
					'fileuploaddone' => 'function(e, data) {
											console.log(e);
											console.log(data.result);
											var dat = JSON.parse(data.result);
											thumbnailUrl = dat.files[0].thumbnailUrl;
											console.log(thumbnailUrl);
											var html = "<img width=200px height=200px src="+thumbnailUrl+" />";
											$("#preview").html(html);
											$("#deck-cover_image").val(thumbnailUrl);
											$("#deck-bg_image").css("min-height","20px");
										}',
					'fileuploadfail' => 'function(e, data) {
											console.log(e);
											console.log(data);
										}',
				],
			]);?>
			<div id="preview">
			<?php  
			if(!$model->isNewRecord){
				echo '<img src="'.$model->cover_image.'" width=200px height=200px />';
			}
			?>
			</div>
			<?php ActiveForm::end(); ?>			
		</li>                                               
	</ul>
	<script src="<?= Yii::$app->request->baseUrl?>/js/select2.js" type="text/javascript"></script>
	<script>
	$(".js-example-basic-multiple").select2();
	</script>

