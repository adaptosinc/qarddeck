<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
</head>
<style>
   .profPic{   
       border-radius: 50%;
       height: 39px;
       width: 44px;
   }
</style> 
<body>
<?php $this->beginBody() ?>
<div class="container-fluid">    
    <!-- header -->
                <header>
                    <div class="logo pull-left">
                        <a href="index.html"><img src="<?= Yii::$app->request->baseUrl?>/images/logo.png" alt="Home"><span>QardDeck</span></a>
                    </div>                   

                    <ul class="pull-right">                        
                     <?php if(\Yii::$app->user->id){ ?>
                        <li>
                            <button class="btn btn-default qard" data-toggle="modal" data-target="#myModaledit">Edit</button>
                        </li>
                        <li>
                            <?php if(\Yii::$app->user->identity->profile_photo){ ?>
                                <img id="profpic" class="profPic" src="<?=\Yii::$app->user->identity->profile_photo?>" alt="">
                            <?php } ?>  
                            <?php if(!\Yii::$app->user->identity->profile_photo){ ?>
                                <img src="<?= Yii::$app->request->baseUrl?>/images/avatar.png" alt="">
                            <?php } ?>      
                        </li>                        
                        <li>
                              <h4><?= Yii::$app->user->identity->firstname; ?></h4>
                              <p>100 Followers  |  100 Following</p>
                        </li>
                        <li>
                            <button class="btn btn-default qard" data-toggle="modal" data-target="">Wall</button>
                        </li>
                        <li>
                            <button class="btn btn-default qard" data-toggle="modal" data-target="">Qards</button>
                        </li>
                        <li>
                            <button class="btn btn-default qard" data-toggle="modal" data-target="">Deck</button>
                        </li>                        

                    <?php } ?>                       
                        <li class="addnew">
                            <div class="dropdown">
                              <a id="dLabel" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="<?= Yii::$app->request->baseUrl?>/images/add.png" alt="" class="menu-add">
                                <img src="<?= Yii::$app->request->baseUrl?>/images/close.png" alt="" class="menu-close">
                              </a>
                            
                              <ul class="dropdown-menu" aria-labelledby="dLabel">
                                            <li>
                                                <div class="col-sm-3 col-md-3 col-md-offset-2">
                                                    <img src="<?= Yii::$app->request->baseUrl?>/images/newqard.png" alt="">
                                                    <h3>Create New Qard</h3>
                                                </div>
                                                <div class="col-sm-3 col-md-3 col-md-offset-1">
                                                    <img src="<?= Yii::$app->request->baseUrl?>/images/newdeck.png" alt="">
                                                    <h3>Create New Deck</h3>
                                                </div>                                                
                                            </li>
                              </ul>
                            </div>                            
                        </li>
                        <li><input type="text" name="search" class="form-control" placeholder="Search Qard"></li>
                        <li>
                            <button class="btn btn-default qard" data-toggle="modal" data-target="">Qard Stream</button>
                        </li>                        
                        <li><?php if(\Yii::$app->user->id){ 
	                        echo Html::beginForm(['/site/logout'], 'post');
	               			echo Html::submitButton(
	                   				'Logout',
	                   			['class' => 'btn btn-default signin']
	               			);
	               			echo Html::endForm();

               } else { ?>
                        <button class="btn btn-default signin" data-toggle="modal" data-target="#myModal">Sign In/Sign Up</button>			    
	        <?php }?>
                        </li>
                        <li>
                            <nav class="navbar">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <i class="fa fa-times-thin"></i>
                                </button>
                            </div>
                            </nav>                       
                                <div id="navbar" class="navbar-collapse collapse">
                                    
                                  <ul class="nav navbar-nav">
                                    <li class="active"><a href="#">Home</a></li>
                                    <li><a href="#about">My Profile</a></li>
                                    <li><a href="#contact">Templates</a></li>
                                    <li><a href="#contact">Getting Started</a></li>
                                    <li><a href="#contact">QardStream</a></li>
                                    <li><a href="#contact">About</a></li>
                                    <li><a href="#contact">Contact Us</a></li>
                                  </ul>
                                </div><!--/.nav-collapse -->
                        </li>
                    </ul>
                </header>    
    <!-- signup popup -->
    <div class="modal fade" tabindex="-1" id="myModal" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <h3>Almost There...</h3>
<p></p>
            <div class="sign-buttons">
                <p><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/facebook/index'; ?>"><button class="btn btn-lg btn-primary"><i class="fa fa-facebook"></i> Sign In/Sign Up with facebook</button></a></p>
                <p><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/twitter/signin'; ?>"><button class="btn btn-lg btn-info"><i class="fa fa-twitter"></i> Sign In/Sign Up with Twitter</button></a></p>
                <p><button class="btn btn-lg btn-default" data-toggle="modal" data-target="#myModalemail"><i class="fa fa-envelope"></i> Sign In/Sign Up with Email</button></p>
            </div>
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    	
    <div class="modal fade" tabindex="-1" id="myModalemail" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="container">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
               <div class="signback">
                           <h3>Almost There...</h3>
                           <button type="button" class="btn btn-sm btn-default close"  data-dismiss="modal" aria-label="Close">Back to Social Login</button> 
               </div>
            <div class="row">
                <div class="col-sm-4 col-md-4 col-md-offset-1">
                    <h3>Sign In Here</h3>
					<?php
					use app\components\SignIn;
					if(!Yii::$app->user->id)
						echo SignIn::widget();
					?>
                </div> 
                <div class="col-sm-4 col-md-4 col-md-offset-1">
                    <h3 class="text-warning">Sign Up Here</h3>
					<?php
					use app\components\SignUp;
					if(!Yii::$app->user->id)
						echo SignUp::widget();
					?>                     
                </div>                         
            </div>
          </div>
            <div class="modal-footer">
                            <p>You agree to our Tems and Conditions of use by publishing your Qard</p>
            </div>
        </div><!-- /.modal-content -->
        </div>
      </div><!-- /.modal-dialog -->
    </div>
        
    <div class="modal fade" tabindex="-1" id="myModaledit" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
              <?php
              use app\components\ProfileWidget;
              if(Yii::$app->user->id)
                      echo ProfileWidget::widget();
              ?>
              
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->   
      
	<div class="modal fade" tabindex="-1" id="myModalError" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
		<h3><?= Yii::$app->session->getFlash('error');?></h3>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->    
    <?= Yii::$app->session->getFlash('success');?>         
    <?= $content ?>     
</div>
<?php $this->endBody() ?>
</body>
<?php
if(Yii::$app->session->getFlash('email_reg_error')){
    echo '<script>$(document).ready(function(){$("#myModalemail").modal("show");});</script>';
}
if(Yii::$app->session->getFlash('profile_update_error')){
    echo '<script>$(document).ready(function(){$("#myModaledit").modal("show");});</script>';
}
?>
</html>
<?php $this->endPage() ?>