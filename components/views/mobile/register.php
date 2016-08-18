<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
				
?>               
                     <?php $form = ActiveForm::begin(); ?>
					 
					   <?= $form->field($model, 'username', [
			'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/user_icon.png' alt='' class='col-xs-2 col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
		])->textInput(['class' => 'col-xs-10 col-sm-10 col-md-10','placeholder'=>'Username/Email address'])->label('Username/Email') ?>
		
                          
						<?= $form->field($model, 'password', [
			'template' => "{label}\n<img src='".\Yii::$app->homeUrl."images/lock_icon.png' alt='' class='col-xs-2 col-sm-2 col-md-2 img-responsive'>{input}\n{hint}\n{error}"
		])->passwordInput(['class' => 'col-xs-10 col-sm-10 col-md-10','placeholder'=>'Password']) ?>
		
			<div class="form-group">
					<span class="pull-right forgot"><a href="">Forgot Password?</a></span>
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-lg qard']) ?>
			</div>							
                       
    <?php ActiveForm::end(); ?>
						
						
                 
 