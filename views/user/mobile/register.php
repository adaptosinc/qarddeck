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
                     <?php $form = ActiveForm::begin(); ?>
					 
                            <div class="form-group">
                                <label>Username/Email</label>
                                <img src="../images/user_icon.png" alt="" class="col-xs-2 col-sm-2 col-md-2 img-responsive"><input type="text" name="LoginForm[username]" class="col-xs-10 col-sm-10 col-md-10" placeholder="Username/Email address">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <img src="../images/lock_icon.png" alt="" class="col-xs-2 col-sm-2 col-md-2 img-responsive"><input type="password" name="LoginForm[password]" class="col-xs-10 col-sm-10 col-md-10" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <span class="pull-right forgot"><a href="">Forgot Password?</a></span>
                                <button class="btn btn-lg qard">Sign In</button>
                            </div>                                     
                       
    <?php ActiveForm::end(); ?>
						
						
                    </div>
                </div>                                          
                </section>
 