<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use app\models\User;
use app\models\UserProfile as Profile;

class SignUp extends Widget
{
    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();
      	$model = new User(); 
		$profile = new Profile();
                
                $model->username = Yii::$app->request->post('username');
                $model->email = Yii::$app->request->post('email');
                $model->password = Yii::$app->request->post('password');
                $profile->firstname = Yii::$app->request->post('firstname');
                $profile->lastname = Yii::$app->request->post('lastname');
		
		//if ($model->load(Yii::$app->request->post())) {
       // if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
          if (Yii::$app->request->post()) {      
         
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
		
				 Yii::$app->user->login($model, '3600*24*30');
                                 return $this->redirect(['site/index']);
			}
				
        } else {
            return $this->render('register', [
                'model' => $model,
				'profile' => $profile,
            ]);
        }
             
    }
}