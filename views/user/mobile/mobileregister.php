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
                        <button type="button" class="btn btn-sm btn-default close pull-left" onclick="location.href='<?= Yii::$app->request->baseUrl?>/user/register';" ><i class="fa fa-chevron-left"></i>&nbsp;Back to Social Login</button>
                        <p class="login-link">Already have an account? <a href="<?= Yii::$app->request->baseUrl?>/user/sign-up">Login in here</a></p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h3>Sign Up</h3>
                       
					   <?php
					use app\components\SignUp;
					if(!Yii::$app->user->id)
						echo SignUp::widget();
					?>   
					
                    </div>
                    <p class="terms">You agree to our <a href=""><strong>Terms and Conditions of Use</strong></a> by signing up</p>
                </div>                                          
                </section>