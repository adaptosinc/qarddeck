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
			'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/user_icon.png' alt='' class='col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
		])->textInput(['class' => 'col-sm-10 col-md-10','placeholder'=>'Username']) ?>

        <?= $form->field($model, 'password', [
			'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/lock_icon.png' alt='' class='col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
		])->passwordInput(['class' => 'col-sm-10 col-md-10','placeholder'=>'Password']) ?>
		
        <div class="form-group">
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-lg qard']) ?>
        </div>
  
    <?php ActiveForm::end(); ?>
</div>
