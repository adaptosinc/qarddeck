<<<<<<< HEAD


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
    <html lang="en">
        <head>
            <title>Qard Deck</title>
            
            <!-- meta -->
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- meta -->
            
            <!-- css -->
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">            
            <link rel="stylesheet" href="../font-awesome/css/font-awesome.css" media="all">
            <link rel="stylesheet" href="../css/master.css" media="all">
            
            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <link rel="stylesheet" href="../css/ie.css">
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
            
        </head>
        <body class="mobile-screen">                
                <!-- header -->
                <header>
                    <div class="logo col-xs-5 col-sm-3 col-md-3 pull-left">
                        <a href="mobile-home.html"><img src="../images/logo.png" alt="Home"><span>QardDeck</span></a>
=======
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
	<?= Html::csrfMetaTags() ?>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:type" content="website" />    
	<!--<meta property="og:title" content="<?=$this->title?>" />  
	<meta property="og:image" itemprop="image primaryImageOfPage" content="http://wordpressmonks.com/works/qarddeck/web/images/logo.png" />
	<meta name="description" property="og:description" itemprop="description" content="Share what you love,think and know. Easily." />-->
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

	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
	</head>
        <body class="mobile-screen">     
		<?php $this->beginBody() ?>		
                <!-- header -->
                <header>
                    <div class="logo col-xs-5 col-sm-3 col-md-3 pull-left">
                        <a href="<?=\Yii::$app->homeUrl?>"><img src="<?=\Yii::$app->homeUrl?>images/logo.png" alt="Home"><span>QardDeck</span></a>
>>>>>>> 08910b9cfb5393617d557e5f3f3f4c92d63de5c1
                    </div>
                    <ul class="col-xs-7 col-sm-9 col-md-9 pull-right">
                        <li class="menu_icon addnew">
                            
                            <div class="dropdown">
                              <a id="dLabel" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
<<<<<<< HEAD
                                <img src="../images/search_icon.png" alt="" class="menu-add">
=======
                                <img src="<?=\Yii::$app->homeUrl?>images/search_icon.png" alt="" class="menu-add">
>>>>>>> 08910b9cfb5393617d557e5f3f3f4c92d63de5c1
                                <span class="menu-close"><i class="fa fa-times-thin"></i></span>
                              </a>
                            
                              <ul class="dropdown-menu mobile-search" aria-labelledby="dLabel">
                                <li>
                                    <h3>Search</h3>
                                    <div class="col-sm-12 col-md-12">
<<<<<<< HEAD
                                        <input type="text" name="search" class="form-control" placeholder="Search QardDeck">
                                    </div>
                                    <div class="search_icon">
                                        <img src="../images/search_icon.png" alt="">
=======
                                        <input type="text" name="search" class="form-control" placeholder="Search Qard">
                                    </div>
                                    <div class="search_icon">
                                        <img src="<?=\Yii::$app->homeUrl?>images/search_icon.png" alt="">
>>>>>>> 08910b9cfb5393617d557e5f3f3f4c92d63de5c1
                                    </div>                                               
                                 </li>
                              </ul>
                            </div>                             
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
<<<<<<< HEAD
                                    <li class="active"><a href="#">Home</a></li>
                                    <li><a href="#about">My Profile</a></li>
                                    <li><a href="#contact">Templates</a></li>
                                    <li><a href="#contact">Getting Started</a></li>
                                    <li><a href="#contact">QardStream</a></li>
                                    <li><a href="#contact">About</a></li>
                                    <li><a href="#contact">Contact Us</a></li>
=======
                                    <li class="active"><a href="<?=\Yii::$app->homeUrl?>">Home</a></li>
                                    <li><a href="<?=\Yii::$app->homeUrl?>qard/my-qards">My Profile</a></li>
                                    <li><a href="#">Templates</a></li>
                                    <li><a href="#">Getting Started</a></li>
                                    <li><a href="<?=\Yii::$app->homeUrl?>qard/index">QardStream</a></li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Contact Us</a></li>
>>>>>>> 08910b9cfb5393617d557e5f3f3f4c92d63de5c1
                                  </ul>
                                </div><!--/.nav-collapse -->

                        </li>
<<<<<<< HEAD
                        <li><?php if(\Yii::$app->user->id){ 
	                        echo Html::beginForm(['/site/logout'], 'post');
	               			echo Html::submitButton(
	                   				'Logout',
	                   			['class' => 'btn btn-default signin']
	               			);
	               			echo Html::endForm();

               } else { ?>
                            <button class="btn btn-default signin" onclick="location.href='<?=\Yii::$app->homeUrl;?>user/register';" >Sign Up</button>
                       <?php }?>

					   </li>  
						
                    </ul>
                </header>
				
                    
                    <?= $content; ?>
            
 <!-- Footer -->
=======
                        <li>
                            <button class="btn btn-default signin" onclick="location.href='mobile-signup.html';">Sign Up</button>
                        </li>                        
                    </ul>
                </header>
                <!--<section class="home-main content">
                    <h1>Share what you love, think, and know. Easily.</h1>
                    <div class="action-qard">
                        <button class="btn btn-warning">Explore the QardStream</button>
                    </div>
                    <div class="qards-list">        <!-- qard list -->
                        <!--<div class="row">
                            <div class="col-sm-3 col-md-3">     <!-- qard -->
                                <!--<div class="qard-list-img">
                                    <img src="../images/curate_illustration.png" alt="">
                                </div>
                                    <h4>Curate & Create</h4>
                            </div>
                            <div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
                                <!--<div class="qard-list-img">
                                    <img src="../images/share_illustration.png" alt="">
                                </div>                            
                                    <h4>Share.</h4>
                            </div>
                            <div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
                                <!--<div class="qard-list-img">
                                    <img src="../images/link_illustration.png" alt="">
                                </div>                            
                                    <h4>Link.</h4>
                            </div>                            
                        </div>      <!-- row  -->
                    <!--</div>      <!-- qard list -->
                    <!--<div class="action-qard">
                        <button class="btn btn-default">Watch the Video</button>
                    </div>                    
                    <div class="section-bottom">
                        <span class="close-section pull-right"><i class="fa fa-times-thin"></i></span>
                        <button class="btn qard" onclick="location.href='mobile-createqard.html';">Create a Qard on Desktop</button>
                        <p>Mobile App coming soon</p>
                    </div>
                </section>-->
				<?= $content; ?>				
                <!-- Footer -->
>>>>>>> 08910b9cfb5393617d557e5f3f3f4c92d63de5c1
                <footer class="container-fluid">
                        <div class="col-sm-6 col-md-6">
                            <div class="mobile-social-links">
                                <ul class="pull-left">
                                    <li class="social-icon"><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li class="social-icon"><a href=""><i class="fa fa-twitter"></i></a></li>                                
                                </ul>
                            </div>
                            <ul class="pull-left">
                                <li><a href="">Qard Stream</a></li>
                                <li><a href="">Terms and Conditions</a></li>
                                <li><a href="">Support</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <p class="copy-right">&copy; QardDeck 2016. All Rights Reserved</p>
                        </div>                        
<<<<<<< HEAD
                </footer>           <!-- Footer End -->
                </div>
        </body>
        
        <!-- javascript -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>        
        <!-- Latest compiled and minified JavaScript -->
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        
    </html>                
	
           
=======
                </footer>           <!-- Footer End -->                    
                </div>
		<?php $this->endBody(); ?>
        </body>

        <script type="text/javascript">
            $(document).ready(function(){
               $('.close-section').click(function(){
                    $('.section-bottom').css('display','none');
               });
            });
        </script>
        
    </html>         
	<?php $this->endPage() ?>	
>>>>>>> 08910b9cfb5393617d557e5f3f3f4c92d63de5c1
