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
<!-- meta -->
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:type" content="website" />    
<meta property="og:title" content="<?=$this->title?>" />  
<meta property="og:image" itemprop="image primaryImageOfPage" content="http://wordpressmonks.com/works/qarddeck/web/images/logo.png" />
<meta name="description" property="og:description" itemprop="description" content="Share what you love,think and know. Easily." />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- meta -->

<!-- css -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">            

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <link rel="stylesheet" href="css/ie.css">
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
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
<div class="container-fluid desktop-view">    
    <!-- header -->
		<header>
			<div class="logo col-sm-3 col-md-3 pull-left">
				<a href="<?=\Yii::$app->homeUrl?>"><img src="<?=\Yii::$app->homeUrl?>images/logo.png" alt="Home"><span>QardDeck</span></a>
			</div>
			<div class="search col-sm-5 col-md-5 col-md-offset-1">
				<div class="col-sm-12 col-md-12">
					<input type="text" name="search" class="form-control" placeholder="Search QardDeck">
				</div>
				<div class="search_icon">
					<img src="<?=\Yii::$app->homeUrl?>images/search_icon.png" alt="">
				</div>
			</div>
			<ul class="col-sm-3 col-md-3 pull-right">
				<li class="addnew">
					<div class="dropdown">
					  <a id="dLabel" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<img src="<?=\Yii::$app->homeUrl?>images/plus_icon.png" alt="" class="menu-add">
						<!--<img src="images/close.png" alt="" class="menu-close">--><span class="menu-close"><i class="fa fa-times-thin"></i></span>
					  </a>
					
					  <ul class="dropdown-menu" aria-labelledby="dLabel">
									<li>
										<div class="col-sm-3 col-md-3 col-md-offset-2">
										   <a href="<?=\Yii::$app->homeUrl?>qard/create"> <img src="<?=\Yii::$app->homeUrl?>images/newqard.png" alt="">
											<h3>Create New Qard</h3></a>
										</div>
										<div class="col-sm-3 col-md-3 col-md-offset-1">
											<a href="<?=\Yii::$app->homeUrl?>deck/create"><img src="<?=\Yii::$app->homeUrl?>images/newdeck.png" alt="">
											<h3>Create New Deck</h3></a>
										</div>                                                
									</li>
					  </ul>
					</div>                            
				</li>
				
				<li class="qard tootip" data-title="Qard Stream">
					<span class="arrow-up"></span>
					<button class="btn btn-default qard" onclick="location.href='<?=\Yii::$app->homeUrl?>qard/index';"><img src="<?=\Yii::$app->homeUrl?>images/qard-stream_icon.png" alt=""></button>
				</li>                        
				<li class="menu_icon">
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
							<li><a href="<?=\Yii::$app->homeUrl?>">Home</a></li>
							<li><a href="<?=\Yii::$app->homeUrl?>/user/profile">My Profile</a></li>
							<li><a href="#contact">Templates</a></li>
							<li><a href="<?=\Yii::$app->homeUrl?>">Getting Started</a></li>
							<li><a href="<?=\Yii::$app->homeUrl?>/qard/index">QardStream</a></li>
							<li><a href="<?=\Yii::$app->homeUrl?>">About</a></li>
							<li><a href="<?=\Yii::$app->homeUrl?>">Contact Us</a></li>
						  </ul>
						</div><!--/.nav-collapse -->

				</li>
                        <li><?php if(\Yii::$app->user->id){ 
	                        echo Html::beginForm(['/site/logout'], 'post');
	               			echo Html::submitButton(
	                   				'Logout',
	                   			['class' => 'btn btn-default signin']
	               			);
	               			echo Html::endForm();

               } else { ?>
                        <button class="btn btn-default signin" onclick="location.href='<?=\Yii::$app->homeUrl;?>user/register';">Sign In/Sign Up</button>			    
	        <?php }?>
                        </li>
                       
			</ul>
		</header>   

		<div align="center" style="color:red"><!--Showing errors -->
			<?= Yii::$app->session->getFlash('error');?>
		</div>
		<div align="center" style="color:green"><!--Showing success -->
			<?= Yii::$app->session->getFlash('success');?>
		</div>
		<?= $content ?>     
		<!-- Footer -->
		<footer class="container-fluid">
				<div class="col-sm-6 col-md-6">
					<ul class="pull-left">
						<li class="social-icon"><a href=""><i class="fa fa-facebook"></i></a></li>
						<li class="social-icon"><a href=""><i class="fa fa-twitter"></i></a></li>
						<li><a href="">Qard Stream</a></li>
						<li><a href="">Terms and Conditions</a></li>
						<li><a href="">Support</a></li>
					</ul>
				</div>
				<div class="col-sm-6 col-md-6">
					<p class="copy-right">&copy; QardDeck 2016. All Rights Reserved</p>
				</div>                        
		</footer>           <!-- Footer End -->
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