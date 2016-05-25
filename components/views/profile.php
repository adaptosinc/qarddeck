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
<!-- Edit Account -->
            <div class="modal-header">       
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
              <h3>Edit Account Info</h3>
              <div class="row">

                  <div class="public-profile col-sm-7 col-md-7">      <!-- public profile -->
                      <h3 class="main-title">Public Profile</h3>
                      <div class="row">
                          <div class="profile-img col-sm-2 col-md-2">
                              <?php if($profile->profile_photo==''){?>
                              <img id="profImg" class="profImg" src="<?= Yii::$app->request->baseUrl?>/images/avatar-lg.png" alt="">
                              <?php } ?>
                              <?php if($profile->profile_photo!=''){?>
                              <img id="profImg" class="profImg" src="<?= Yii::$app->request->baseUrl.'/'.$profile->profile_photo?>" alt="">
                              <?php } ?>

                              <input id="profile-image-upload" name="image" class="hidden" type="file">
                                       </div>
                          <div class="profile-content col-sm-10 col-md-10">
                              <h3>@<?= Html::encode($this->title) ?></h3>
                              <?php $form = ActiveForm::begin([
                                  //'id' => 'edit_form_profile',
                                  'options' => ['enctype' => 'multipart/form-data']
                                  
                                  ]); ?>
                              <div class="form-group">
                              <?= $form->field($profile, 'firstname', [
                                              'template' => "{input}\n{hint}\n{error}"
                                      ])->textInput(['class' => 'form-control','placeholder'=>'First Name']) ?>
                              
                                   <?= $form->field($profile, 'lastname', [
                                              'template' => "{input}\n{hint}\n{error}"
                                      ])->textInput(['class' => 'form-control','placeholder'=>'Last Name']) ?>
                             
                           <?= $form->field($profile, 'short_description', [
                                              'template' => "{input}\n{hint}\n{error}"
                                      ])->textInput(['class' => 'form-control','placeholder'=>'Something about yourself (x char max)']) ?>
                              
                              </div>

                        <!--<div class="form-group">    
                         <!-- < ?= 
                                  //$form->field($profile, 'profile_photo')->fileInput() //? >
                          < ?= $form->field($profile, 'profile_bg_image')->fileInput() ?> 
                        </div>-->
                          <div class="form-group" style="display: inline-block;">
                            <div class="col-sm-6 col-md-6">
                              <img src="<?= Yii::$app->request->baseUrl?>/images/email-trans.png" alt="">

                               <?= $form->field($model, 'email', [
                                              'template' => "{input}\n{hint}\n{error}"
                                      ])->textInput(['class' => 'form-control','placeholder'=>'Email Adddress']) ?>
                            </div>
                             <div class="col-sm-6 col-md-6">
                                  <div class="switch">
                                      
                                      <?php if($profile->isEmailEnabled==0){?>
                                      <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                      <?php }?>
                                      <?php if($profile->isEmailEnabled==1){?>
                                      <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round"  checked="checked" type="checkbox">
                                      <?php }?>
                                      
                                      <label for="cmn-toggle-4"></label>
                                  </div>  <span>Display email on public profile</span>                                                   
                              </div>                                            
                              </div>
                              <div class="form-group">
                                            <img src="<?= Yii::$app->request->baseUrl?>/images/link-trans.png" alt="">
                               <?= $form->field($profile, 'profile_url', [
                                              'template' => "{input}\n{hint}\n{error}"
                                      ])->textInput(['class' => 'form-control link','placeholder'=>'Link Optional']) ?>               
                              </div>       
      
                          </div>
                      </div>
                  </div>          <!-- public profile -->
                  <?php if(\Yii::$app->user->identity->login_type == 'email'){  ?>
					  <div class="col-sm-4 col-md-4 col-md-offset-1">
						  <h3 class="main-title">Change Your Password</h3>
							 <input type="password" id="cur_password" class="form-control" name="cur_password" placeholder="Current Password">          
					   <span id="ispswdvalid" class="text-danger">Please Enter The Correct Password</span>  
							<?= $form->field($profile, 'password_profile', [
								'template' => "{input}\n{hint}\n{error}"
								])->passwordInput(['class' => 'form-control password','placeholder'=>'New Password']) ?>
							<?= $form->field($profile, 'verify_password_profile', [
								'template' => "{input}\n{hint}\n{error}"
								])->passwordInput(['class' => 'form-control verify_password','placeholder'=>'Re-enter Password']) ?>
						 <span id="displayerr" class="text-danger">Password And The Confirm Password Should Be The Same</span>
					  </div>					  
				 <?php  } ?>

              </div>          <!-- row -->
              <?php if(Yii::$app->session->getFlash('twitter-success')){?>
              <h5 class="text-success" style="margin-left:10px;"><b>You are successfully connected with twitter..</b></h5>
              <?php } ?>
               <?php if(Yii::$app->session->getFlash('fb-success')){?>
              <h5 class="fb-success" style="margin-left:10px;"><b>You are successfully connected with fb..</b></h5>
              <?php } ?>
               <div class="social-ccount">
                            <h3>Connect Social Accounts</h3>
                            <div class="form-group">
                            <?php if(\Yii::$app->user->identity->login_type != 'facebook' && !$profile->fb_status){?>     
                            <button class="btn btn-lg btn-primary fb-btn"><i class="fa fa-facebook"></i> Connect facebook account</button><?php } ?>
                             <?php if(\Yii::$app->user->identity->login_type != 'twitter' && !$profile->tw_status){?>  
                            <button class="btn btn-lg btn-info  twit-btn"><i class="fa fa-twitter"></i>Connect Twitter account
                                <?php } ?>
                              <?php if($profile->fb_status){?>    
                                 <button class="btn btn-lg btn-danger fb-dsbtn"><i class="fa fa-facebook"></i> Disconnect facebook account</button><?php } ?>
                              <?php if($profile->tw_status){?>  
                            <button class="btn btn-lg btn-danger  twit-dsbtn"><i class="fa fa-twitter"></i>Disconnect Twitter account
                                  <?php } ?>
                            </div>
                            
                </div>
              <div class="form-group">
                    <ul class="pull-right">
                  <li> <?= Html::submitButton('Cancel', ['class' => 'btn btn-lg btn-default']) ?>  </li>
                  <li> <?= Html::submitButton('Update', ['class' => 'btn btn-lg btn-warning updatebtn']) ?></li>
                    </ul>
              </div>   
              <?php ActiveForm::end(); ?>
            </div>                    
<style>
   .profImg{   
       border-radius: 50%;
       height: 108px;
       width: 106px;
   }
</style>       
<script>
  $(document).ready(function(){
   var count =1;
        $('#displayerr').hide();
        $('#ispswdvalid').hide();
        $('#islinkvalid').hide();
	$('#profImg').on('click', function() {
        $('#profile-image-upload').click(); 
            
        });
        $('input[type=file]').change(function(e){
           // $('#profile-image-upload').click();
               var file_data = $('#profile-image-upload').prop('files')[0];   
               var form_data = new FormData();                  
               form_data.append('file', file_data);
               console.log('<?= $profile->user_id?>');
                    $.ajax({
                           url: "<?=Url::to(['user/photo'], true)?>",
                           cache: false,
                           contentType: false,
                           processData: false,
                           data: form_data,                        
                           type: 'post',
                           success: function(response){   
                               
                               $('#profImg').attr('src', '<?= Yii::$app->request->baseUrl?>/uploads/'+response.code);
                               count++;
                           }
                    });
        }); 
        $('#cur_password').change(function(e){
            if($('#cur_password').val()!=''){
               checkPassword();
            }else{
                $('#ispswdvalid').hide();
                $(".updatebtn").removeAttr("disabled");      
            }
        });
        $('#link').change(function(e){
           var val = $('#link').val();            
           if (val && !val.match(/^http([s]?):\/\/.*/)) {
                $('#islinkvalid').show();
                $(".updatebtn").attr("disabled", "disabled");
           }else{
                $('#islinkvalid').hide();
                $(".updatebtn").removeAttr("disabled");
           }
        });
        function checkPassword(){
        
            var file_data = $('#cur_password').val();   

                        $.ajax({
                               url: "<?=Url::to(['user/password'], true)?>",                           
                               data: {data: file_data },                        
                               type: 'post',
                               success: function(response){   
                                   if(!response.result){
                                        $('#ispswdvalid').show();
                                        $(".updatebtn").attr("disabled", "disabled");
                                   }else{
                                        $('#ispswdvalid').hide();
                                        $(".updatebtn").removeAttr("disabled");       
                                   }
                               }
                        });
      }
        
    $('.verify_password').on('blur', function() {
        var password = $('.password').val();
        var verify_password = $('.verify_password').val();
        if(password != verify_password){
             $('#displayerr').show();
             $(".updatebtn").attr("disabled", "disabled");
             checkPassword();
        }  else{
            $('#displayerr').hide();
            $(".updatebtn").removeAttr("disabled");         
            checkPassword();
        }
    });     
    $('.twit-btn').click(function(e) {
        e.preventDefault();
        window.location.replace("<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/twitter/connecttwitter'; ?>");
        
    });   
    $('.fb-btn').click(function(e) {
        e.preventDefault();
        window.location.replace("<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/facebook/facebook'; ?>");
    }); 
     $('.twit-dsbtn').click(function(e) {
        e.preventDefault();
        window.location.replace("<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/twitter/dis-twitter'; ?>");        
    });   
    $('.fb-dsbtn').click(function(e) {
        e.preventDefault();
        window.location.replace("<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/facebook/dis-facebook'; ?>");
    });     
        $("#cmn-toggle-4").click(function(e){        
         if($(this).prop("checked") == true){
             file_data = 1;
        }else{
             file_data = 0;
        }
        $.ajax({
                               url: "<?=Url::to(['user/display'], true)?>",                           
                               data: {data: file_data },                        
                               type: 'post',
                               success: function(){   
                                 
                               }
                        });
    });
   });    
</script>
                                                               
