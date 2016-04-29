
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

 
    <!-- signup with email popup -->

    <div class="modal fade" tabindex="-1" id="myModalemail" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="container">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-md-offset-1">
                    <h3>Sign In Here</h3>
                    <!--<form>
                        <div class="form-group">
                            <img src="<?= Yii::$app->request->baseUrl?>/images/user.png" alt="" class="user-img"><input type="text" name="username" class="form-control" placeholder="Username/Email address">
                        </div>
                        <div class="form-group">
                            <img src="<?= Yii::$app->request->baseUrl?>/images/pass.png" alt="" class="pass-img"><input type="text" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-default">Sign In</button>
                        </div>                                    
                    </form>-->
                </div>
                <div class="col-sm-4 col-md-4 col-md-offset-1">
                    <h3>Sign Up Here</h3>
					<?php
					use app\components\SignUp;
					?>
					<?= SignUp::widget() ?>
					
                    <!--<form method="post" action="<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/user/register'; ?>">
                         <div class="form-group">
                            <img src="<?= Yii::$app->request->baseUrl?>/images/user.png" alt="" class="user-img">
                             
                            <input type="text" name="username" class="form-control" placeholder="User name" required>
                        </div>
                        <div class="form-group">
                            <img src="<?= Yii::$app->request->baseUrl?>/images/user.png" alt="" class="user-img">
                             
                            <input type="text" name="firstname" class="form-control" placeholder="First name" required>
                        </div>
                        <div class="form-group">
                            <img src="<?= Yii::$app->request->baseUrl?>/images/user.png" alt="" class="user-img"><input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                            <img src="<?= Yii::$app->request->baseUrl?>/images/mail.png" alt="" class="mail-img"><input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <img src="<?= Yii::$app->request->baseUrl?>/images/pass.png" alt="" class="pass-img"><input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <img src="<?= Yii::$app->request->baseUrl?>/images/pass.png" alt="" class="pass-img"><input type="password" name="password" class="form-control" placeholder="Re-enter Password" required>
                        </div>                                    
                        <div class="form-group">
                            <button class="btn btn-lg btn-default">Sign Up</button>
                        </div>                                    
                    </form>-->
                     
                </div>                            
            </div>

          </div>

        </div><!-- /.modal-content -->
        </div>
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->    
<section class="home-main content">
    <h3>Share what you love,think and know. <strong>Easily.</strong></h3>
    <div class="action-qard">
	<button class="btn btn-default qard">Qards in Action</button>
	<button class="btn btn-warning">Create a Qard</button>
	<button class="btn btn-default qard">Introductory Video</button>
    </div>
    <div class="qards-list">        <!-- qard list -->
	<div class="row">
	    <div class="col-sm-3 col-md-3">     <!-- qard -->
		<div class="qard-content">

		</div>
		<div class="qard-bottom">
		    <h4>Curate & Create</h4>
		</div>
	    </div>
	    <div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
		<div class="qard-content">

		</div>
		<div class="qard-bottom">
		    <h4>Share</h4>
		</div>
	    </div>
	    <div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
		<div class="qard-content">

		</div>
		<div class="qard-bottom">
		    <h4>Link</h4>
		</div>
	    </div>                            
	</div>      <!-- row  -->
    </div>      <!-- qard list -->
</section>
