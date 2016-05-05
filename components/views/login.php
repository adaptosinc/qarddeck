<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signin-new">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username', [
			'template' => "{input}\n{hint}\n{error}"
		])->textInput(['class' => 'form-control','placeholder'=>'Username']) ?>

        <?= $form->field($model, 'password', [
			'template' => "{input}\n{hint}\n{error}"
		])->passwordInput(['class' => 'form-control','placeholder'=>'Password']) ?>
		
        <div class="form-group">
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-lg btn-default']) ?>
        </div>
  
    <?php ActiveForm::end(); ?>
</div>
