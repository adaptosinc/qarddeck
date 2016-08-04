<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?= \Yii::$app->session->getFlash('email_reg_error'); ?>

<section class="email-signin content">
        <div class="row">
            <div class="signback">
                <button type="button" class="btn btn-sm btn-default close pull-left" data-dismiss="modal" aria-label="Close" onclick="location.href='<?=\Yii::$app->homeUrl?>user/register';"><i class="fa fa-chevron-left"></i>&nbsp;Back to Social Login</button>
                <h3>Almost there...</h3>                           
            </div> 
                <div class="col-sm-4 col-md-4 col-md-offset-1">
                    <h3>Log In</h3>
					<?php
					use app\components\SignIn;
					if(!Yii::$app->user->id)
						echo SignIn::widget();
					?>
                </div> 
                <div class="col-sm-4 col-md-4 col-md-offset-1">
                    <h3>Sign Up</h3>
					<?php
					use app\components\SignUp;
					if(!Yii::$app->user->id)
						echo SignUp::widget();
					?>                     
                </div>  				
			</div>
<p class="terms">You agree to our <a href=""><strong>Terms and Conditions of Use</strong></a> by signing up.</p>
</section>
