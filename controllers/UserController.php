<?php

namespace app\controllers;

use Yii;
use app\models\User;

//use app\models\UserProfile as Profile;
use app\models\UserProfile;

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

		$profile = UserProfile::findOne(['user_id' => $id]);
		
        return $this->render('view', [
            'model' => $this->findModel($id),
			'profile' => $profile ,
        ]);
    }
	/**
	 * Handles user registration
	 * If creation is successful, the browser will be redirected to the 'login' page.
	 * @return mixed
	 */
    public function actionRegister(){
        $model = new User(); 

        $model->scenario = 'registration';
        $profile = new UserProfile();

               //if ($model->load(Yii::$app->request->post())) {
       if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            $model->setPassword($model->password);
            $model->generateAuthKey();

            if($model->save(false)){

                $profile->user_id = $model->id;			
                $profile->save();				

                //mail function	

                $subject = "Please verify your email address";
                $ref = "http://localhost/qarddeck/web/site/activate?key=".$model->auth_key;

                $param = "Hi ".$model->username.", <br>Help us secure your qarddeck account by verifying your email address (nandhini@abacies.com). This lets you access all of qarddeck's features.<br>Please click on the link to make it acess<br><a href=".$ref.">check";

                Yii::$app->mailer->compose()
                ->setFrom('nandhini@abacies.com')
                ->setTo('nandhinicomforters@gmail.com')
                ->setSubject($subject)
                ->setHtmlBody($param)
                ->send();
                $profile = new Profile();
                    if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {

                        $model->setPassword($model->password);
                                    $model->generateAuthKey();

                                    if($model->save(false)){
                                            $profile->user_id = $model->id;
                                            //print_r($profile);exit;
                                            $profile->save();

                                            return $this->redirect(['view', 'id' => $model->id]);
                                    }

                    } else {
                        return $this->render('register', [
                            'model' => $model,
                                            'profile' => $profile,
                        ]);
                    }
        }
       }
    }
    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */    
    public function actionCreate(){
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

     **/
  
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

	protected function findProfile($id)
    {
        if (($model = UserProfile::findOne(['user_id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	public function actionProfile(){
		
		$model = User::find()->where(['id' => \Yii::$app->user->id])->one();		 
		$profile = UserProfile::find()->where(['user_id' => \Yii::$app->user->id])->one();	
		
        if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {		
		
				$profile->profile_photo = UploadedFile::getInstance($profile, 'profile_photo');
				$profile->profile_bg_image = UploadedFile::getInstance($profile, 'profile_bg_image');		
				$prof_img_path =  $profile->profile_photo->baseName . '.' . $profile->profile_photo->extension;
				$background_img_path =  $profile->profile_bg_image->baseName . '.' .$profile->profile_bg_image->extension;
				$idToUpdate =  \Yii::$app->user->id;				
			//if ($model->validate()) {         

				$profile->profile_photo->saveAs('uploads/'.$profile->profile_photo->baseName . '.' . $profile->profile_photo->extension);
				$profile->profile_bg_image->saveAs('uploads/'.$profile->profile_bg_image->baseName . '.' . $profile->profile_bg_image->extension);
				//$base_url = Yii::$app->baseUrl();
				$profile->profile_photo  = '/uploads/'.$prof_img_path;
				$profile->profile_bg_image = '/uploads/'.$background_img_path;
				$model->save();
				$profile->save();
			//}
			//save both profile and user\
            return $this->redirect(['view', 'id' => $model->id]);
        } else {           
			return $this->render('profile', [
				'model' => $model,
				'profile' => $profile
			]);
		}
		
	}	
}



