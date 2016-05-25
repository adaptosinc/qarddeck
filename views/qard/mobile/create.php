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

            
                <!-- mobile view qard half -->
                <div class="container-fluid mobile-page">
                    <section class="home-main content">
                        <div class="mobile-qardcreate">
                            <h2>Yay!</h2>
                            <img src="<?= Yii::$app->request->baseUrl?>/images/mobile-success.png" alt="">
                            <h4 style="color:#ff741b;">However, unit our mobile app is out the door, creating Qards is available only on Desktop</h4>
                            <h4>Get a magic link sent to your email so that you can start creating on your Desktop</h4>
                            <div class="form-group">
                                <img src="<?= Yii::$app->request->baseUrl?>/images/email-trans.png" alt=""><input type="text" name="email" placeholder="Email Address">
                            </div>
                            <button class="btn btn-lg btn-warning">Send Magic Link</button>
                            
                            <p>Every magic link sent gives our Mobile team more reason to stay late and bring you QardDeck for Mobile!</p>
                        </div>
                        
                    </section>                    
                    
                </div>                
            
            
        </body>
        
        <!-- javascript -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        
    </html>