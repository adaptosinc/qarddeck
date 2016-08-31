<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\UserProfile as Profile;

class SiteController extends Controller
{
     public function behaviors()
    {
        return [
		
			'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],                   
                ],
            ],
			
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            
        ];
    }
 
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex(){
        $model = new User(); 
        $profile = new Profile();
        if(!$this->isMobile()){
            return $this->render('index', [
                'model' => $model,
                'profile' => $profile,
            ]);        
        }else{
            $this->layout = 'mobile';
             return $this->render('mobile/home', [
                'model' => $model,
                'profile' => $profile,
            ]);   
        }
    }

    public function actionLogin(){
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
/*         $model = new LoginForm();	    
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]); */
		$ref = Yii::$app->request->referrer;
		\Yii::$app->session['ref-url'] = $ref;
		return $this->redirect(['user/register']);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionActivate($key,$red_url=null){
        
		$validUser = User::find()->where(['auth_key' => $key])->one();		
		$profile = Profile::find()->where(['user_id' => $validUser->id])->one();		
		if (isset($validUser)) {
			$validUser->status = 10;
			if($validUser->save()){
				Yii::$app->user->login($validUser,'3600*24*30');		
				Yii::$app->getSession()->setFlash('Success', 'Your Account Is Acivated Successfully');	

				if($red_url)	{
					//wil be handled later
				}
						//then redirect to the specified url					
			}else{
                            return $this->redirect(array('/user/profile', 'id' => $validUser->id));
                            //return $this->redirect('../user/profile');                        
                        }		
		}			
    }
    public function beforeAction($action){       
        
        if ($action->id == 'register') {
            $this->enableCsrfValidation = false;
			return parent::beforeAction($action);
        }
        
		if (parent::beforeAction($action)) {
			// change layout for error action
			if ($action->id=='error')
				 $this->layout ='Error';
			return true;
		} else {
			return false;
		}
    } 
    
    public function isMobile(){
         return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    
     public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
	
	 public function actionSetPassword($key=null){
        
		$validUser = User::find()->where(['auth_key' => $key])->one();	
				
		
		if (isset($validUser)) {
				$profile = Profile::find()->where(['user_id' => $validUser->id])->one();
				Yii::$app->user->login($validUser,'3600*24*30');		
				Yii::$app->getSession()->setFlash('Success', 'Your Account Is Acivated Successfully');	
				  return $this->redirect(array('/user/new-password'));
					
			
		} else { return $this->redirect(array('/site/index')); }
	 }
	
	
	
}