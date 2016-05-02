<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\Controller;
use app\models\User;
use app\models\UserProfile as Profile;

class SignUp extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
      	$model = new User(); 
		$profile = new Profile();

        if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post()) ) {
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
				$model->generateAuthKey();			
				if($model->save(false)){				
					$profile->user_id = $model->id;			
					$profile->save();								
					//mail function					
					$subject = "Please verify your email address";
					$ref = "http://localhost/qarddeck/web/site/activate?key=".$model->auth_key;
				
					$param = "Hi ".$model->username.", <br>Help us secure your qarddeck account by verifying your email address (nandhini@abacies.com). This lets you access all of qarddeck's features.<br>Please click on the link to make it acess<br><a href=".$ref.">check";
					
					Yii::$app->mailer->compose()
						->setFrom('admin@wordpressmonks.com')
						->setTo($model->email)
						->setSubject($subject)
						->setHtmlBody($param)
						->send();
					\Yii::$app->getSession()->setFlash('success', "Please dont forget to verify your email. Have a great day");
					\Yii::$app->user->login($model, '3600*24*30');
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
}