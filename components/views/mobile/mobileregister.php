<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
                    
			<?php $form = ActiveForm::begin(['class' => 'signup-new']); ?>

				<?= $form->field($model, 'username', [
					'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/user_icon.png' alt='' class='col-xs-2 col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
				])->textInput(['class' => 'col-xs-10 col-sm-10 col-md-10','placeholder'=>'Username']) ?>

				<?= $form->field($profile, 'firstname', [
					'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/user_icon.png' alt='' class='col-xs-2 col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
				])->textInput(['class' => 'col-xs-10 col-sm-10 col-md-10','placeholder'=>'First name'])->label('First name') ?>
		
		
				<?= $form->field($profile, 'lastname', [
					'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/user_icon.png' alt='' class='col-xs-2 col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
						])->textInput(['class' => 'col-xs-10 col-sm-10 col-md-10','placeholder'=>'Last name'])->label('Last name') ?>
		
				<?= $form->field($model, 'email', [
					'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/email_icon.png' alt='' class='col-xs-2 col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
					])->textInput(['class' => 'col-xs-10 col-sm-10 col-md-10','placeholder'=>'Email']) ?>	
					
				

				<?= $form->field($model, 'password', [
					'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/lock_icon.png' alt='' class='col-xs-2 col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
						])->passwordInput(['class' => 'col-xs-10 col-sm-10 col-md-10','placeholder'=>'Password']) ?>

					<span class="pull-right"><i>Must have atleast 6 characters</i></span>
                    

				<?= $form->field($model, 'verify_password', [
					'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/lock_icon.png' alt='' class='col-xs-2 col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
						])->passwordInput(['class' => 'col-xs-10 col-sm-10 col-md-10','placeholder'=>'Verify Password'])->label('Verify Password') ?>

				<div class="form-group">
					<?= Html::submitButton('Sign up', ['class' => 'btn btn-lg btn-warning']) ?>
				</div>  
						
			<?php ActiveForm::end(); ?>
                  