<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserProfile as Profile;
use app\models\search\User as UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{       
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	public function actionSignUp(){
      	$model = new User(); 
		$profile = new Profile();

        if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post()) ) {
			//print_r(Yii::$app->request->post());die;
			$model->validate();
			if($model->errors){
				foreach($model->errors as $error){
					\Yii::$app->getSession()->setFlash('email_reg_error', $error[0]);
				}

				return $this->render('register', [
					'model' => $model,
					'profile' => $profile,
				]);

			}
			else{
				$model->setPassword($model->password);
                              // print_r($model->password);die;
				$model->generateAuthKey();	
				$model->login_type = "email";
				$profile->temp_image = "images/avatar.png";
                          // print_r($model); die;
				if($model->save(false)){			                                    
                    $profile->user_id = $model->id; 
					$profile->save();                                    
					//mail function					
					$subject = "Please verify your email address";
					$ref = Url::to(['site/activate','key' => $model->auth_key], true);
					$param = "Hi ".$model->username.", <br>Help us secure your qarddeck account by verifying your email address . This lets you access all of qarddeck's features.<br>Please click on the link to make it acess<br><a href=".$ref.">check";
					
					Yii::$app->mailer->compose()
						->setFrom('admin@wordpressmonks.com')
						->setTo($model->email)
						->setSubject($subject)
						->setHtmlBody($param)
						->send();
					\Yii::$app->getSession()->setFlash('success', "Please dont forget to verify your email. Have a great day");
					\Yii::$app->user->login($model, '3600*24*30');
					if(isset(Yii::$app->session['qard']) && Yii::$app->session['qard'] != '' ){
						\Yii::$app->controller->redirect(['qard/publish']);
					}
					else
					\Yii::$app->controller->redirect(['site/index']);
				}				
				
			}

				
        } else {
            return $this->render('register', [
                'model' => $model,
				'profile' => $profile,
            ]);
        }	
	}
	/**
	 * Handles user registration
	 * If creation is successful, the browser will be redirected to the 'login' page.
	 * @return mixed
	 */
	 public function actionRegister(){

            return $this->render('social_signin');

	 }
    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
			$model->setPassword($model->password);
			$model->generateAuthKey();
			
			if($model->save())
				return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
     /**
     * @inheritdoc
     */
    public function beforeAction($action){            
        
        if ($action->id == 'register') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
    
    	protected function findProfile($id)
    {
        if (($model = Profile::findOne(['user_id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	/**
     * Save the UserProfile model based on its primary key value.
     * If the model is saved, view action will be called.
     * If the model is not saved, will be in the same profile actionss.
     * @param integer $id
     * @return mixed
     */
    public function actionProfile(){ 
        return $this->render('profile');
	}	
    /**
     * Uploads the Profile Picture
     * @return uploaded file name
     */    
    public function actionPhoto(){
		$idToUpdate =  \Yii::$app->user->id;
		$profile = Profile::find()->where(['user_id' => $idToUpdate])->one();
		if (Yii::$app->request->isAjax) {                
		   $move = Yii::$app->basePath.'/web/uploads/';              
		   $moveto = $move.$_FILES["file"]['name'];
		   $_FILES["file"]['tmp_name'];
		   $_FILES["file"]['size'];
		   $_FILES['file']['error'];
				if(file_exists($move.$_FILES["file"]['name'])) {
					 //chmod($move.$_FILES["file"]['name'],0755); //Change the file permissions if allowed
					 unlink($move.$_FILES["file"]['name']); //remove the file
				 }
		   move_uploaded_file($_FILES['file']['tmp_name'], $move.$_FILES["file"]['name']);
		   $prof_img_path =  $_FILES["file"]['name'];
		   $profile->temp_image = "uploads/".$prof_img_path; 
		   $profile->save(false);
		   \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return [
				'code' => $_FILES["file"]['name'],
			];
	   }  
	}	
        
    /**
    * Checks The Current Password Exists
    * @return uploaded file name
    */    
   public function actionPassword(){               
           if (Yii::$app->request->isAjax) { 
              $checkPswd =  Yii::$app->request->post('data');
              $idToUpdate =  \Yii::$app->user->id;
              $model = User::find()->where(['id' => $idToUpdate])->one();
              $status = $model->validatePassword($checkPswd);                  
              \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return [
                            'result' => $status,
                        ];
          }                                  
   }
   
    /**
    * Update Display Email Public 
    * @return uploaded file name
    */    
   public function actionDisplay(){               
           if (Yii::$app->request->isAjax) { 
              $emailStatus =  Yii::$app->request->post('data');
              $idToUpdate =  \Yii::$app->user->id;
              $profile = Profile::find()->where(['user_id' => $idToUpdate])->one();
              $profile->isEmailEnabled = $emailStatus;      
              $profile->save();
            //  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
             
          }                                  
   }
    /**
    * Remove Profile Picture
    * @return uploaded file name
    */    
   public function actionRemove(){              
		   $idToUpdate =  \Yii::$app->user->id;
           if (Yii::$app->request->isAjax) { 
              $profile = Profile::find()->where(['user_id' => $idToUpdate])->one();
              $profile->temp_image = "images/avatar-lg.png";   
              $profile->save();
            //  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
             
          }                                  
   }
}