<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Deck */
/* @var $form yii\widgets\ActiveForm */

use dosamigos\fileupload\FileUpload;
?>
<div class="deck-form">
	<?php $form = ActiveForm::begin(); ?>
	<?= FileUpload::widget([
		'model' => $model,
		'attribute' => 'bg_image',
		'url' => ['deck/set-cover-image'], // your url, this is just for demo purposes,
		'options' => ['accept' => 'image/*','class'=>'yes'],
		'clientOptions' => [
			'maxFileSize' => 2000000
		],
		// Also, you can specify jQuery-File-Upload events
		// see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
		'clientEvents' => [
			'fileuploaddone' => 'function(e, data) {
									console.log(e);
								//	var html = "<img src=data.url";
									console.log(data.result);
									console.log(data.result);
								}',
			'fileuploadfail' => 'function(e, data) {
									console.log(e);
									console.log(data);
								}',
		],
	]);?>
	<div id="preview">Preview</div>
    <?= $form->field($model, 'bg_image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
