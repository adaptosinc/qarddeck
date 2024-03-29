<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\Controller;
use app\models\User;
use app\models\UserProfile as Profile;
use yii\helpers\Url;

class SignUp extends Widget
{
    public function init()
    {
        parent::init();
    }

	 public function isMobile(){
         return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
	
    public function run()
    {
      	$model = new User(); 
		$profile = new Profile();

        if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post()) ) {
			//print_r(Yii::$app->request->post());die;
			$model->validate();
			if($model->errors){
				foreach($model->errors as $error){
					\Yii::$app->getSession()->setFlash('email_reg_error', $error[0]);
				}
	
				if(!$this->isMobile()){ 				
					return $this->render('register', ['model' => $model,'profile' => $profile, ]);			
				}else{
					return $this->render('mobile/mobileregister' ,['model' => $model,'profile' => $profile,]); 
				}			
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
						return "";
					}
					else{
						\Yii::$app->controller->redirect(['site/index']);
						return "";
					}
					
				}				
				
			}

				
        } else {			
			if(!$this->isMobile()){ 				
				return $this->render('register', ['model' => $model,'profile' => $profile,]);			
			}else{
				return $this->render('mobile/mobileregister' ,['model' => $model,'profile' => $profile,]); 
			}			           
        }
             
    }
}