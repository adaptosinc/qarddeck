<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username', [
			'template' => "<img src='". \Yii::$app->request->baseUrl."/images/user.png' alt='' class='user-img'>{input}\n{hint}\n{error}"
		])->textInput(['class' => 'form-control','placeholder'=>'User name']) ?>
		
    <?= $form->field($profile, 'firstname', [
			'template' => "<img src='". \Yii::$app->request->baseUrl."/images/user.png' alt='' class='user-img'>{input}\n{hint}\n{error}"
		])->textInput(['class' => 'form-control','placeholder'=>'First name']) ?>
		
	<?= $form->field($profile, 'lastname', [
			'template' => "<img src='". \Yii::$app->request->baseUrl."/images/user.png' alt='' class='user-img'>{input}\n{hint}\n{error}"
		])->textInput(['class' => 'form-control','placeholder'=>'Last name']) ?>
	
	<?= $form->field($model, 'email', [
			'template' => "<img src='". \Yii::$app->request->baseUrl."/images/mail.png' alt='' class='user-img'>{input}\n{hint}\n{error}"
		])->textInput(['class' => 'form-control','placeholder'=>'Email']) ?>	
	<?= $form->field($model, 'password', [
			'template' => "<img src='". \Yii::$app->request->baseUrl."/images/pass.png' alt='' class='user-img'>{input}\n{hint}\n{error}"
		])->passwordInput(['class' => 'form-control','placeholder'=>'Password']) ?>
	<?= $form->field($model, 'verify_password', [
			'template' => "<img src='". \Yii::$app->request->baseUrl."/images/pass.png' alt='' class='user-img'>{input}\n{hint}\n{error}"
		])->passwordInput(['class' => 'form-control','placeholder'=>'Re-enter Password']) ?>

    <div class="form-group">
        <?= Html::submitButton('Sign Up', ['class' => 'btn btn-lg btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>