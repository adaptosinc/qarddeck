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
							<?php if($profile->profile_photo==''){?>
							  <img id="profImg" class="profImg" src="<?= Yii::$app->request->baseUrl?>/images/avatar-lg.png" alt=""> 
							  <?php }else { ?>
							  <img id="profImg" class="profImg" src="<?= $profile->profile_photo?> " alt="">
							  <br>
							<button type="button" class="btn  btn-warning remImg"><span class="glyphicon glyphicon-trash"></span></button>
							  <?php } ?>
							  <?php if(\Yii::$app->user->identity->login_type == 'facebook') {
								//fetch id here
								$arr = explode('_',\Yii::$app->user->identity->username);
								$f_id = $arr[1];
							  ?>
							  <img id="profImg" class="profImg" src="//graph.facebook.com/<?php echo $f_id;?>/picture?type=large">
							  <?php } ?>
							  <input id="profile-image-upload" name="image" class="hidden" type="file">
							  
                                            </div>
                                            <div class="col-xs-9 col-sm-9 col-md-9">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" placeholder="Username" readonly  value="@<?= Html::encode($this->title)?>">
                                            </div>                                            
                                        </div>
										
							<?= $form->field($profile, 'firstname', ['template' => "{label}\n{input}\n{hint}\n{error}"
								])->textInput(['class' => 'form-control','placeholder'=>'First Name'])->label('First Name') ?>
								
                                     
							<?= $form->field($profile, 'lastname', [
										'template' => "{label}\n{input}\n{hint}\n{error}"
								])->textInput(['class' => 'form-control','placeholder'=>'Last Name'])->label('Last Name') ?> 			
										
								<?= $form->field($profile, 'display_email', [
										'template' => "{label}\n{input}\n{hint}\n{error}"
							])->textInput(['class' => 'form-control','placeholder'=>'Email Adddress'])->label('Email') ?>

							
                                        <div class="form-group">
                                       
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
										
										 <?= $form->field($profile, 'short_description', [
									  'template' => "{label}\n{input}\n{hint}\n{error}"
							  ])->textarea(['class' => 'form-control','placeholder'=>'Something about yourself (x char max)'])->label('Something about yourself'); ?>
							  
							  
                                    
							<?= $form->field($profile, 'profile_url', [
									  'template' => "{label}\n{input}\n{hint}\n{error}"
							  ])->textInput(['class' => 'form-control link','placeholder'=>'Link Optional']) ?>

							                                    
                                    </div>
                                </div>
                            </div>          <!-- public profile -->
                            <div class="col-sm-4 col-md-4 col-md-offset-1">
                                <h3 class="main-title">Change Your Password</h3>
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" id="cur_password" class="form-control" name="cur_password" placeholder="Current Password" >
                                </div>
								<span id="ispswdvalid" class="text-danger" style="display: none;">Please Enter The Correct Password</span>
								
								<?= $form->field($profile, 'password_profile', [
						'template' => "{label}\n{input}\n{hint}\n{error}"
						])->passwordInput(['class' => 'form-control password','placeholder'=>'New Password'])->label("New Password") ?>
						
						   <span class="pull-right">Must have atleast 6 characters</span>
                             
							<?= $form->field($profile, 'verify_password_profile', [
						'template' => "{label}\n{input}\n{hint}\n{error}"
						])->passwordInput(['class' => 'form-control verify_password','placeholder'=>'Re-enter Password'])->label("Verify New Password") ?>	
								
                               
								
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
                                    <li class="pull-right col-xs-6">
									<?= Html::submitButton('Save Changes', ['class' => 'btn btn-lg btn-warning updatebtn']) ?>
									<!--<button class="btn btn-lg btn-warning">Save Changes</button></li> -->                    
                                </ul>
                            </div>  
	  <?php ActiveForm::end(); ?>							
                        </div>          <!-- row -->                                          
                </section>
				
<script>
  $(document).ready(function(){
   var count =1;
        $('#displayerr').hide();
        $('#ispswdvalid').hide();
        $('#islinkvalid').hide();
	$('#profImg').on('click', function() {
          $('#profile-image-upload').click();             
        });
        //$('input[type=file]').change(function(e){
        $('input[id=profile-image-upload]').change(function(e){
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
                               console.log(response);
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
			if(file_data == ''){
				   $('#ispswdvalid').show();
                                        $(".updatebtn").attr("disabled", "disabled");
			}else{
				 $('#ispswdvalid').hide();
                                        $(".updatebtn").removeAttr("disabled");     
			}
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
    
      $('.cancelbtn').click(function(e) {          
        e.preventDefault();
          location.reload();
        //$( ".close" ).trigger( "click" );
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
	 $(".remImg").click(function(e){   	
	 
	  $.ajax({
                           url: "<?=Url::to(['user/remove'], true)?>",
                           cache: false,
                           contentType: false,
                           processData: false,
                                         
                           type: 'post',
                           success: function(response){   
                               console.log(response);
                               $('#profImg').attr('src', '<?= Yii::$app->request->baseUrl?>/images/avatar-lg.png');
                               count++;
                           }
                    });
	 });
	 
   });    
</script>   				
             