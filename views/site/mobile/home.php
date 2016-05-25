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
                    <section class="home-main content">
                        <h3>Share what you love,think and know. <strong>Easily.</strong></h3>
                        <div class="qards-list">        <!-- qard list -->
                            <div class="row">
                                <div class="col-sm-12 col-md-3">     <!-- qard -->
                                    <div class="qard-content">
                                        
                                    </div>
                                    <div class="qard-bottom">
                                        <h4>Curate & Create</h4>
                                    </div>
                                </div>                           
                            </div>      <!-- row  -->
                        </div>      <!-- qard list -->
                        <ul class="mobile-create">
                            <li><button class="btn btn-default dark">Qard Stream</button></li>
                            
                            <li><a href="<?= Yii::$app->request->baseUrl?>/qard/create"><button class="btn btn-warning">Create Qard</button></a></li>
                        </ul>
                    </section>                    
                    
                </div>
        </body>
        
        <!-- javascript -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        
    </html>                