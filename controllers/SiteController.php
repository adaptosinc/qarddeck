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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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

    public function actionIndex()
    {
        $model = new User(); 
        $profile = new Profile();
        return $this->render('index', [
            'model' => $model,
            'profile' => $profile,
        ]);
    }

    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();	    
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
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
        }

        return parent::beforeAction($action);
    }
    
}