<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;


					
?>

<section class="email-signin content">                    
                    <div class="signback">
                        <button type="button" class="btn btn-sm btn-default close pull-left"  onclick="location.href='<?= Yii::$app->request->baseUrl?>/user/register';"><i class="fa fa-chevron-left"></i>&nbsp;Back to Social Login</button>
                        <p class="login-link">Don't have an account? <a href="<?= Yii::$app->request->baseUrl?>/user/mobile-register">Create one here</a></p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h3>Log In</h3>
						<?php 
						use app\components\SignIn;
						if(!Yii::$app->user->id)
						echo SignIn::widget();
	
						?>
						   </div>
                </div>                                          
                </section>
				
 