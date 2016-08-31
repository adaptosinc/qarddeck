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
	
		<div class="row">
		
		 <?= Yii::$app->session->getFlash('newpwd_success'); ?>
		  </br>
			<?php $form = ActiveForm::begin([ 'id' => 'form_newpassword' ]); ?>
			<!-- Public profile -->
			 <div class=" col-sm-2 col-md-2 ">  
			 </div>
		    <div class="public-profile col-sm-4 col-md-4 col-md-offset-2">      <!-- public profile -->
			    <h3 class="main-title">New Password</h3>
				<div class="row">
				 <?= $form->field($profile, 'password_profile', [
						'template' => "{label}\n{input}\n{hint}\n{error}"
						])->passwordInput(['class' => 'form-control password','placeholder'=>'New Password'])->label("New Password"); ?>
						<div class="text-danger" id="error-new_password"  ></div>
					<?= $form->field($profile, 'verify_password_profile', [
						'template' => "{label}\n{input}\n{hint}\n{error}"
						])->passwordInput(['class' => 'form-control verify_password','placeholder'=>'Re-enter Password'])->label("Confirm Password"); ?>
						
						<span id="displayerr" class="text-danger">Password And The Confirm Password Should Be The Same</span>
						
			    </div>
		    </div>         
			<!-- public profile -->
			<!-- Change Your Password and social account -->
		  
		<!-- Change Your Password and social account -->
	    </div>          <!-- row -->
	    <div class="update col-xs-12 col-md-9 col-md-offset-2">
			<ul>
				<li class="pull-left"> 
					<button type="reset" class="btn btn-lg btn-grey cancelbtn">Cancel </button>
				</li>
		        <li class="pull-right"> <?= Html::submitButton('Save', ['class' => 'btn btn-lg btn-warning updatebtn']) ?></li>
			</ul>
	    </div>   
	  <?php ActiveForm::end(); ?>
	</div>  
</section>	
 
<script>
  $(document).ready(function(){
	$('#displayerr').hide();
	
	
	$(".password").blur(function() 
		{
		  var password_length = $(".password").val().length;

		 if( parseInt(password_length) < 6 || parseInt(password_length) > 10 ) 
			{
			 $("#error-new_password").html('Password Length should be within 6 to 10 character'); 
			 return false;
			}			
		 else
			{
			 $("#error-new_password").html('');
			}			 
		});

		$('.verify_password').on('blur', function() {
			var password = $('.password').val();
			var verify_password = $('.verify_password').val();
			
			if( $.trim(password) != $.trim(verify_password) ){
				 $('#displayerr').show();                    
			}  else{
				$('#displayerr').hide();  
				return false;	
			}
		});    
	
	
		$( "#form_newpassword" ).submit(function( ) {
				var password = $('.password').val();
				var verify_password = $('.verify_password').val();
				
				if($.trim(password) != $.trim(verify_password) ){
					 $('#displayerr').show(); 
					 return false;				
				}  else{
					$('#displayerr').hide();  				
				}				
		});
});
</script>			
