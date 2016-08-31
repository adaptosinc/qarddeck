 <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?= \Yii::$app->session->getFlash('email_reg_error'); ?>

 <section class="email-signin content">                    
                    <div class="signback">
                       
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h3>User Management</h3>
                       	<?= Yii::$app->session->getFlash('reg_success'); ?>		
					   <?php
					use app\components\UserManagement;
					if((Yii::$app->user->id) && (Yii::$app->user->identity->role == "admin"))
						echo UserManagement::widget();
					?>   
					
                    </div>
                    <p class="terms">You agree to our <a href=""><strong>Terms and Conditions of Use</strong></a> by signing up</p>
                </div>                                          
                </section>