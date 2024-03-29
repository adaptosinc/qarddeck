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
 

<div id="editd" class="modal-header">       
  <h4 class="modal-title"></h4>
</div>
<section class="main-profile">
	<div class="modal-body">
		<h3>Edit Account Info</h3>
		<div class="row">
		
		 <?= Yii::$app->session->getFlash('pwd_success'); ?>
		  </br>
			<?php $form = ActiveForm::begin([
					  //'id' => 'edit_form_profile',
					  'options' => ['enctype' => 'multipart/form-data']
			]); ?>
			<!-- Public profile -->
		    <div class="public-profile col-sm-4 col-md-4 col-md-offset-2">      <!-- public profile -->
			    <h3 class="main-title">Public Profile</h3>
				<div class="row">
				    <div class="profile-content">
						<div class="form-group">
							<div class="profile-img col-sm-4 col-md-4">
							<p id="loading" align="center" style="display:none" >
									<img src="<?php echo \Yii::$app->homeUrl; ?>images/loading7.gif" width="100px" height="35px" alt="Loading…" />
								</p>
							  <?php if($profile->profile_photo==''){?>
							  <img id="profImg" class="profImg" src="<?= Yii::$app->request->baseUrl?>/images/avatar-lg.png" alt=""> 
							  
							  <?php }else { ?>
							  <img id="profImg" class="profImg" src="<?= $profile->profile_photo?> " alt="">							  
							  <br>
							<button type="button" class="btn  btn-warning remImg"><span class="glyphicon glyphicon-trash">RemoveImage</span></button>
							  <?php } ?>

							  <input id="profile-image-upload" name="image" class="hidden" type="file">
						  </div>
						  <div class="col-sm-8 col-md-8">
							<label>USER NAME</label>
							 <input type="text" class="form-control" placeholder="User Name" value="@<?= Html::encode($this->title)?>" readonly>     
							</div>
						</div>
						<div class="form-group">
							 <?= $form->field($profile, 'firstname', [
										'template' => "{label}\n{input}\n{hint}\n{error}"
								])->textInput(['class' => 'form-control','placeholder'=>'First Name']) ?>
							<?= $form->field($profile, 'lastname', [
										'template' => "{label}\n{input}\n{hint}\n{error}"
								])->textInput(['class' => 'form-control','placeholder'=>'Last Name']) ?>    
						</div>
						
						<div class="form-group">
							<div class="">
							
							<?= $form->field($profile, 'display_email', [
										'template' => "{label}\n{input}\n{hint}\n{error}"
							])->textInput(['class' => 'form-control','placeholder'=>'Email Adddress']) ?>
							<span id="emailerr" style="display:none"  class="text-danger">Invalid email Address </span>
							</br>
							</div>
							
							<div class="">
								<div class="switch" style="float: left;">                                      
								  <?php if($profile->isEmailEnabled==0){?>
								  <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox">
								  <?php }?>
								  <?php if($profile->isEmailEnabled==1){?>
								  <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round"  checked="checked" type="checkbox">
								  <?php }?>                                      
								  <label for="cmn-toggle-4"></label>
								</div>  <span style="float: left; margin-left: 15px; margin-top: 7px; " >Display email on public profile</span>                                          
							</div>                                            
						</div>
					    <div class="form-group">
					        <?= $form->field($profile, 'short_description', [
									  'template' => "{label}\n{input}\n{hint}\n{error}"
							  ])->textarea(['class' => 'form-control','placeholder'=>'Something about yourself (x char max)','onkeyup'=>"countChar(this)"]) ?>
							  <div id="charNum" class="text-danger" ></div>
							  </br>
							  
					        <?= $form->field($profile, 'profile_url', [
									  'template' => "{label}\n{input}\n{hint}\n{error}"
							  ])->textInput(['class' => 'form-control','placeholder'=>'Link Optional']) ?>               
					    </div>     
						
				    </div>
			    </div>
		    </div>         
			<!-- public profile -->
			<!-- Change Your Password and social account -->
		    <?php if(\Yii::$app->user->identity->login_type == 'email'){  ?>
			
			
			 
			    <div class="col-sm-4 col-md-4">
				    <h3 class="main-title">Change Your Password</h3>
				    <div class="form-group">
					    <label>CURRENT PASSWORD</label>
						<input type="password" id="cur_password" class="form-control" name="cur_password" placeholder="Current Password" value="">     
					</div>
					<span id="ispswdvalid" class="text-danger">Please Enter The Correct Password</span>  
					<?= $form->field($profile, 'password_profile', [
						'template' => "{label}\n{input}\n{hint}\n{error}"
						])->passwordInput(['class' => 'form-control password','placeholder'=>'New Password']) ?>
					<?= $form->field($profile, 'verify_password_profile', [
						'template' => "{label}\n{input}\n{hint}\n{error}"
						])->passwordInput(['class' => 'form-control verify_password','placeholder'=>'Re-enter Password']) ?>
					<span id="displayerr" class="text-danger">Password And The Confirm Password Should Be The Same</span>
					<hr class="divider">
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
								<button class="btn btn-lg btn-primary fb-btn"><i class="fa fa-facebook"></i> Connect facebook account</button>
							<?php } ?>
							<?php if(\Yii::$app->user->identity->login_type != 'twitter' && !$profile->tw_status){?>  
								<button class="btn btn-lg btn-info  twit-btn"><i class="fa fa-twitter"></i>Connect Twitter account
							<?php } ?>
							<?php if($profile->fb_status){?>    
								 <button class="btn btn-lg btn-danger fb-dsbtn"><i class="fa fa-facebook"></i> Disconnect facebook account</button>
							<?php } ?>
							<?php if($profile->tw_status){?>  
								<button class="btn btn-lg btn-danger  twit-dsbtn"><i class="fa fa-twitter"></i>Disconnect Twitter account
							<?php } ?>
						</div>	
					</div>
			    </div>					  
			<?php  } ?>
		<!-- Change Your Password and social account -->
	    </div>          <!-- row -->
	    <div class="update col-md-9 col-md-offset-2">
			<ul>
				<li class="pull-left"> 
					<button class="btn btn-lg btn-grey cancelbtn">Cancel </button>
				</li>
		        <li class="pull-right"> <?= Html::submitButton('Update', ['class' => 'btn btn-lg btn-warning updatebtn']) ?></li>
			</ul>
	    </div>   
	  <?php ActiveForm::end(); ?>
	</div>  
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
                           },
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