<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username', [
			'template' => "<img src='". \Yii::$app->request->baseUrl."/images/user.png' alt='' class='user-img'>{input}\n{hint}\n{error}"
		])->textInput(['class' => 'form-control','placeholder'=>'Username']) ?>

        <?= $form->field($model, 'password', [
			'template' => "<img src='". \Yii::$app->request->baseUrl."/images/pass.png' alt='' class='user-img'>{input}\n{hint}\n{error}"
		])->passwordInput(['class' => 'form-control','placeholder'=>'Password']) ?>
		
		<div class="form-group">
			<?= Html::submitButton('Sign In', ['class' => 'btn btn-lg btn-default']) ?>
		</div>
		<?php ActiveForm::end(); ?>


</div>
