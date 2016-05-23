<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="signup-new">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username', [
			'template' => "{input}\n{hint}\n{error}"
		])->textInput(['class' => 'form-control','placeholder'=>'User name']) ?>
		
    <?= $form->field($profile, 'firstname', [
			'template' => "{input}\n{hint}\n{error}"
		])->textInput(['class' => 'form-control','placeholder'=>'First name']) ?>
		
	<?= $form->field($profile, 'lastname', [
			'template' => "{input}\n{hint}\n{error}"
		])->textInput(['class' => 'form-control','placeholder'=>'Last name']) ?>
	
	<?= $form->field($model, 'email', [
			'template' => "{input}\n{hint}\n{error}"
		])->textInput(['class' => 'form-control','placeholder'=>'Email']) ?>	
	<?= $form->field($model, 'password', [
			'template' => "{input}\n{hint}\n{error}"
		])->passwordInput(['class' => 'form-control','placeholder'=>'Password']) ?>
	<?= $form->field($model, 'verify_password', [
			'template' => "{input}\n{hint}\n{error}"
		])->passwordInput(['class' => 'form-control','placeholder'=>'Re-enter Password']) ?>

    <div class="form-group">
        <?= Html::submitButton('So you want in do you - Sign up', ['class' => 'btn btn-lg btn-warning']) ?>
    </div>     
    <?php ActiveForm::end(); ?>
</div>