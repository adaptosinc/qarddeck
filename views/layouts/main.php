<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

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
<body>
<?php $this->beginBody() ?>
<div class="container-fluid">
                
                <!-- header -->
                <header>
                    <div class="logo pull-left">
                        <a href=""><img src="<?= Yii::$app->request->baseUrl?>/images/logo.png" alt="Home"><span>QardDeck</span></a>
                    </div>
                    <ul class="pull-right">
                        <li class="addnew">
                            <div class="dropdown">
                              <a id="dLabel" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="<?= Yii::$app->request->baseUrl?>/images/add.png" alt="" class="menu-add">
                                <img src="<?= Yii::$app->request->baseUrl?>/images/close.png" alt="" class="menu-close">
                              </a>
                            
                              <ul class="dropdown-menu" aria-labelledby="dLabel">
                                            <li>
                                                <div class="col-sm-3 col-md-3 col-md-offset-2">
						    <a href="<?= Yii::$app->request->baseUrl.'/blocks/blocks/create'?>">
                                                    <img src="<?= Yii::$app->request->baseUrl?>/images/newqard.png" alt="">
						    
                                                    <h3>Create New Qard</h3>
						    </a>
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
                        <li>
                            <button class="btn btn-default signin" data-toggle="modal" data-target="#myModal">Sign In/Sign Up</button>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        <h3>Almost There...</h3>
                        <p>Choose how you want to sign in/sign up</p>
                        <div class="sign-buttons">
                            <p><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/facebook/index'; ?>"><button class="btn btn-lg btn-primary"><i class="fa fa-facebook"></i> Sign In/Sign Up with facebook</button></a></p>
                            <p><a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].(Yii::$app->request->baseUrl).'/social/twitter/signin'; ?>"><button class="btn btn-lg btn-info"><i class="fa fa-twitter"></i> Sign In/Sign Up with Twitter</button></a></p>
                            <p><button class="btn btn-lg btn-default" data-toggle="modal" data-target="#myModalemail"><i class="fa fa-envelope"></i> Sign In/Sign Up with Email</button></p>
                        </div>
                      </div>

                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                
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
                                <form>
                                    <div class="form-group">
                                        <img src="<?= Yii::$app->request->baseUrl?>/images/user.png" alt="" class="user-img"><input type="text" name="username" class="form-control" placeholder="Username/Email address">
                                    </div>
                                    <div class="form-group">
                                        <img src="<?= Yii::$app->request->baseUrl?>/images/pass.png" alt="" class="pass-img"><input type="text" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-default">Sign In</button>
                                    </div>                                    
                                </form>
                            </div>
                            <div class="col-sm-4 col-md-4 col-md-offset-1">
                                <h3>Sign Up Here</h3>
                                <form>
                                    <div class="form-group">
                                        <img src="<?= Yii::$app->request->baseUrl?>/images/user.png" alt="" class="user-img"><input type="text" name="firstname" class="form-control" placeholder="First name">
                                    </div>
                                    <div class="form-group">
                                        <img src="<?= Yii::$app->request->baseUrl?>/images/user.png" alt="" class="user-img"><input type="text" name="lastname" class="form-control" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <img src="<?= Yii::$app->request->baseUrl?>/images/mail.png" alt="" class="mail-img"><input type="text" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <img src="<?= Yii::$app->request->baseUrl?>/images/pass.png" alt="" class="pass-img"><input type="text" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <img src="<?= Yii::$app->request->baseUrl?>/images/pass.png" alt="" class="pass-img"><input type="text" name="password" class="form-control" placeholder="Re-enter Password">
                                    </div>                                    
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-default">Sign Up</button>
                                    </div>                                    
                                </form>
                            </div>                            
                        </div>

                      </div>

                    </div><!-- /.modal-content -->
                    </div>
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                
                <?= $content ?> 
                
            </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
