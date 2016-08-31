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
                <h3>User Management</h3>                           
            </div>  
				<?= Yii::$app->session->getFlash('reg_success'); ?>			
                <div class="col-sm-4 col-md-4 col-md-offset-1" style="min-height: 320px !important">             
					<?php
					use app\components\UserManagement;
					if((Yii::$app->user->id) && (Yii::$app->user->identity->role == "admin"))
						echo UserManagement::widget();
					?>                     
                </div>  				
			</div>
<p class="terms">You agree to our <a href=""><strong>Terms and Conditions of Use</strong></a> by signing up.</p>
</section>
