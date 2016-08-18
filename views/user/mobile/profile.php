<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Edit Profile', 'url' => ['profile']];
$this->params['breadcrumbs'][] = 'Edit';


?>   

                <section class="main-profile">                    
                        <h3 class="modal-title">Edit Your Account Info</h3>
                        <div class="row">
						
						<?php $form = ActiveForm::begin([
					  //'id' => 'edit_form_profile',
					  'options' => ['enctype' => 'multipart/form-data']
			]); ?>
			
                            <div class="public-profile col-sm-4 col-md-4 col-md-offset-1">      <!-- public profile -->
                                <h3 class="main-title">Public Profile</h3>
                                <div class="row">
                                    <div class="profile-content">                                        
                                        <div class="form-group">
                                            <div class="profile-img col-xs-3 col-sm-3 col-md-3">
                                                <img src="../images/avatar-lg.png" alt="">
                                            </div>
                                            <div class="col-xs-9 col-sm-9 col-md-9">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" placeholder="Username" readonly  value="@<?= Html::encode($this->title)?>">
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" id="userprofile-firstname" class="form-control" name="UserProfile[firstname]" placeholder="First Name" value="<?=$profile->firstname;?>">                                            
                                        </div>
										 <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" id="userprofile-lastname" class="form-control" name="UserProfile[lastname]" placeholder="Last Name" value="<?=$profile->lastname;?>">                                            
                                        </div>
										
                                        <div class="form-group">
                                            <div class="col-sm-12 col-md-12" style="padding: 0;">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="UserProfile[display_email]" id="userprofile-display_email" placeholder="Email Adddress" value="<?=$profile->display_email;?>">
                                            </div>
                                            <div class="col-sm-12 col-md-12" style="padding: 0;margin: 10px 0;">
                                                <div class="switch">
												  <?php if($profile->isEmailEnabled==0){?>
                                                    <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox">
													 <?php }?>
												  <?php if($profile->isEmailEnabled==1){?>
												    <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox" checked="checked">
												  <?php }?>  
                                                    <label for="cmn-toggle-4"></label>
                                                </div>  <span>Display email on public profile</span>                                                   
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Something about yourself</label>
                                            <textarea id="userprofile-short_description" class="form-control" name="UserProfile[short_description]"  placeholder="Something about yourself (x char max)"><?=$profile->short_description; ?></textarea>
                                        </div>                                        
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input type="text" id="userprofile-profile_url" class="form-control" name="UserProfile[profile_url]" value="<?=$profile->profile_url;?>" placeholder="Link Optional">
                                        </div>                                        
                                    </div>
                                </div>
                            </div>          <!-- public profile -->
                            <div class="col-sm-4 col-md-4 col-md-offset-1">
                                <h3 class="main-title">Change Your Password</h3>
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" id="cur_password" class="form-control" name="cur_password" placeholder="*******">
                                </div>
								<span id="ispswdvalid" class="text-danger" style="display: none;">Please Enter The Correct Password</span>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input id="userprofile-password_profile" type="password" class="form-control" placeholder="*******"  name="UserProfile[password_profile]" >
                                    <span class="pull-right">Must have atleast 6 characters</span>
                                </div>
                                <div class="form-group">
                                    <label>Verify New Password</label>
                                    <input id="userprofile-verify_password_profile" type="password" class="form-control" placeholder="*******" name="UserProfile[verify_password_profile]" >
                                </div>
								<span id="displayerr" class="text-danger">Password And The Confirm Password Should Be The Same</span>
								
                               
								<hr class="divider">
					<?php if(Yii::$app->session->getFlash('twitter-success')){?>
						<h5 class="text-success" style="margin-left:10px;"><b>You are successfully connected with twitter..</b></h5>
					<?php } ?>
					<?php if(Yii::$app->session->getFlash('fb-success')){?>
						<h5 class="fb-success" style="margin-left:10px;"><b>You are successfully connected with fb..</b></h5>
					<?php } ?>
					
                                <div class="social-ccount">
                                    <h3>Connect  Accounts</h3>
                                    <div class="form-group">
									<?php if(\Yii::$app->user->identity->login_type != 'facebook' && !$profile->fb_status){?>  
                                        <button class="btn btn-lg btn-primary"><i class="fa fa-facebook"></i> Connect facebook account</button>
									<?php } ?>
							<?php if(\Yii::$app->user->identity->login_type != 'twitter' && !$profile->tw_status){?> 
                                        <button class="btn btn-lg btn-info"><i class="fa fa-twitter"></i>Connect Twitter account</button>
										<?php } ?>
                                    </div>
                                    
                                </div>                                
                            </div>
                            <div class="update col-xs-12 col-md-9 col-md-offset-1">
                                <ul>
                                    <li class="pull-left col-xs-6"><button class="btn btn-lg btn-grey">Cancel</button></li>
                                    <li class="pull-right col-xs-6"><button class="btn btn-lg btn-warning">Save Changes</button></li>                     
                                </ul>
                            </div>  
	  <?php ActiveForm::end(); ?>							
                        </div>          <!-- row -->                                          
                </section>
				
<script>
   $(document).ready(function(){
	   alert('asdasdasd');

	
   });    
</script> 				
             