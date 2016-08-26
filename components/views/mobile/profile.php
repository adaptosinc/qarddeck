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
						 <?= Yii::$app->session->getFlash('pwd_success'); ?>
						 </br>
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
											
											<p id="loading" align="center" style="display:none" >
									<img src="<?php echo \Yii::$app->homeUrl; ?>images/loading7.gif" width="100px" height="35px" alt="Loading…" />
								</p>
								
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
							<span id="emailerr" style="display:none"  class="text-danger">Invalid email Address </span>
							
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
							  
							   <div id="charNum" class="text-danger" ></div>
                                    
							<?= $form->field($profile, 'profile_url', [
									  'template' => "{label}\n{input}\n{hint}\n{error}"
							  ])->textInput(['class' => 'form-control link','placeholder'=>'Link Optional']) ?>

							                                    
                                    </div>
                                </div>
                            </div>          <!-- public profile -->
						
			<?php if(\Yii::$app->user->identity->login_type == 'email'){  ?>
 
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
							
			<?php } ?>	
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
		   $('#loading').show();
		  $('#profImg').hide();
		  
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
							   $('#loading').hide();
							   $('#profImg').show();
                           }
						   error:function(){
							$('#loading').hide();
							$('#profImg').show();
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
        
		
		
		function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
		};
	
	 $("#userprofile-display_email").on("change", function () {
		 if($.trim($("#userprofile-display_email").val()) !="" )
		 {
			if (!ValidateEmail($("#userprofile-display_email").val())) 
				{
					$("#emailerr").show();
					return false;
				}				
			else 
				$("#emailerr").hide();
		 }else 
			$("#emailerr").hide();
			
    });
	
	
	
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
	 
	 
	 
			$( "#w0" ).submit(function( event ) {
					if($.trim($("#userprofile-display_email").val()) !="" )
					 {
						if (!ValidateEmail($("#userprofile-display_email").val())) 
							{
								$("#emailerr").show();
								$(".field-userprofile-display_email").removeClass("has-success");
								$(".field-userprofile-display_email").addClass("has-error");
								return false;
							}				
							else 
								$("#emailerr").hide();
					 }else 
						$("#emailerr").hide();
				  
			});

		$('#userprofile-short_description').keyup(function () {
			  var max = 100;
			  var len = $(this).val().length;
			  if (len >= max) {
				$('#charNum').text(' You have reached the limit');
			  } else {
				var char = max - len;
				$('#charNum').text(char + ' characters left');
			  }
		});

		$('#userprofile-short_description').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
		
		$('#userprofile-short_description').keypress(function (event) {
			var max = 100;
			var len = $(this).val().length;
			if (event.which < 0x20) {			
				return; 
			}
			if (len >= max) {
			event.preventDefault();
			}

		});
  
  
   });    
</script>   				
             