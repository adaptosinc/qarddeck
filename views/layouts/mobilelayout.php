<!DOCTYPE html>
    <html lang="en">
        <head>
            <title>Qard Deck</title>
            
            <!-- css -->
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">            
            <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/font-awesome/css/font-awesome.css" media="all">
            <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/css/master.css" media="all">
            
        </head>
        <body>                
                <!-- mobile view -->
                <div class="container-fluid mobile-page">
                    <header>
                        <div class="logo col-xs-10 col-sm-10 pull-left">
                            <img src="<?= Yii::$app->request->baseUrl?>/images/logo.png" alt=""><span>QardDeck</span>
                        </div>
                        <div class="mobile-menus">
                            <nav class="navbar">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_mobile" aria-expanded="false" aria-controls="navbar_mobile">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>                                        
                                        </button>
                                    </div>
                            </nav>                                                     
                                    <div id="navbar_mobile" class="navbar-collapse collapse">
                                        
                                      <ul class="nav navbar-nav">
                                        <li class="active"><a href="#">Qard Stream</a></li>
                                        <li><a href="#about">About</a></li>
                                      </ul>
                                    </div><!--/.nav-collapse --> 
                        </div>                        
                        
                    </header>       <!-- header -->
                    
                    <?= $content; ?>
                </div>
           