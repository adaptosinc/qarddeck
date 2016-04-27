<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Login_model;
use app\models\User;
use app\models\UserProfile;
use app\models\UploadForm;
use yii\web\UploadedFile;
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
        return $this->render('index');
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
        return $this->render('contact', ['model' => $model,]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
	public function actionActivate1($key){
		
		//$profile=new UserProfile();
		$validUser = User::find()->where(['auth_key' => $key])->one();		
		$profile = UserProfile::find()->where(['user_id' => $validUser->id])->one();	
	
		if (isset($validUser)) {
			Yii::$app->user->login($validUser,'3600*24*30');
			
			if ($validUser->load(Yii::$app->request->post())&& $profile->load(Yii::$app->request->post()) ) {
				$validUser->file = UploadedFile::getInstance($validUser, 'file');
				$validUser->image = UploadedFile::getInstance($validUser, 'image');
								
				if ($validUser->validate()  ) { 
				
					$validUser->update();
					$profile->update();
					$validUser->file->saveAs('uploads/' . $validUser->file->baseName . '.' . $validUser->file->extension);
					$validUser->image->saveAs('uploads/' .$validUser->image->baseName . '.' . $validUser->image->extension);
				    $prof_img_path =  $validUser->file->baseName . '.' . $validUser->file->extension;
					$background_img_path =  $validUser->image->baseName . '.' .$validUser->image->extension;
					$idToUpdate = $validUser->id;
				    Yii::$app->db->createCommand()->update('user_profile', ['profile_photo' => $prof_img_path], 'user_id ='.$idToUpdate.'')->execute(); //manually update image name to db		
					Yii::$app->db->createCommand()->update('user_profile', ['profile_bg_image' => $background_img_path],'user_id ='.$idToUpdate.'')->execute(); //manually update image name to db		 //manually update image name to db							//$validUser->file->saveAs('uploads/' . $validUser->file->baseName . '.' . $validUser->file->extension);
				}else{
					print_r($profile);
					print_r($validUser->errors);die;
				}
				 return $this->redirect(['user/view', 'id' => $validUser->id]);
			} else {
			     return $this->render('../user/profile', ['model' => $validUser,'profile' => $profile,]);
			}
			
		}else {
			Yii::$app->getSession()->setFlash('error', 'Your Account Is Invalid');
			return $this->render(['login']);		
		}
		
    }	
	
	public function actionActivate($key,$red_url=null){
		$validUser = User::find()->where(['auth_key' => $key])->one();		
		$profile = UserProfile::find()->where(['user_id' => $validUser->id])->one();	

		if (isset($validUser)) {
			$validUser->status = 10;
			//print_r($validUser);exit;
			if($validUser->save()){
                            	echo "<pre>";print_r($validUser);die;
				Yii::$app->user->login($validUser,'3600*24*30');		
				Yii::$app->getSession()->setFlash('Success', 'Your Account Is Acivated Successfully');	

				if($red_url)	{
					//wil be handled later
				}
						//then redirect to the specified url
				
					
			}else{
					return $this->redirect(['user/profile']);
                                }
					
		
		}	
		
	}
}