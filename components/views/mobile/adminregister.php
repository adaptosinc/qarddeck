<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
        <?php $password = sprintf("%06d", mt_rand(1, 999999)); ?>
			<?php $form = ActiveForm::begin(['class' => 'signup-new']); ?>

				<?= $form->field($model, 'username', [
					'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/user_icon.png' alt='' class='col-xs-2 col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
				])->textInput(['class' => 'col-xs-10 col-sm-10 col-md-10','placeholder'=>'Username']) ?>

 <?= $form->field($profile, 'firstname', ['template' => "{input}"])->hiddenInput(['value'=>'First Name' ]) ?>
 <?= $form->field($profile, 'lastname', ['template' => "{input}"])->hiddenInput(['value'=>'Last Name'] ) ?>
		
				<?= $form->field($model, 'email', [
					'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/email_icon.png' alt='' class='col-xs-2 col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
					])->textInput(['class' => 'col-xs-10 col-sm-10 col-md-10','placeholder'=>'Email']) ?>	
					
				
 <?= $form->field($model, 'password', ['template' => "{input}"])->hiddenInput(['value'=>$password ]) ?>
		
 <?= $form->field($model, 'verify_password', ['template' => "{input}"])->hiddenInput(['value'=>$password ])  ?> 

 <?= $form->field($model, 'role', ['template' => "{input}"])->hiddenInput(['value'=>'admin'] ) ?>
		
		
				<div class="form-group">
					<?= Html::submitButton('Create User', ['class' => 'btn btn-lg btn-warning']) ?>
				</div>  
						
			<?php ActiveForm::end(); ?>
   <style>
	.drop-height{
		height:40px;
	}
</style>              

<script>
$(".field-userprofile-firstname").hide();
$(".field-userprofile-lastname").hide();
$(".field-user-password").hide();
$(".field-user-verify_password").hide();
</script> 