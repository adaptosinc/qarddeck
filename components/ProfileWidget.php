<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\Controller;
use app\models\User;
use app\models\UserProfile as Profile;

class ProfileWidget extends Widget
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
        $id =  \Yii::$app->user->id;
        $model = User::find()->where(['id' => $id])->one();		
        $profile = Profile::find()->where(['user_id' => $id])->one();	
        
        if($profile->load(Yii::$app->request->post())){
          $currentpwd = Yii::$app->request->post()['cur_password'];
		  
		   
            $newProfile = Profile::find()->where(['user_id' => $id])->one();
			$profile->profile_photo = \Yii::$app->homeUrl.$newProfile->temp_image; 			
            //$profile->validate();
            if($profile->errors || $model->errors){
                    foreach($model->errors as $error){
                            \Yii::$app->getSession()->setFlash('profile_update_error', $error[0]);
                    }
                    foreach($profile->errors as $error){
                            \Yii::$app->getSession()->setFlash('profile_update_error', $error[0]);
                    }
                    
                   if(!$this->isMobile()){ 	 
						return $this->render('profile', ['model' => $model,'profile' => $profile]);
					} else {			  
						return $this->render('mobile/profile',['model' => $model,'profile' => $profile ]);  
					}	
            };
	
			if(!empty($currentpwd))
			{
				if(!empty($profile->password_profile) && !empty($profile->verify_password_profile) && ($profile->password_profile == $profile->verify_password_profile ))
				{
					if($model->validatePassword($currentpwd))
					{										
						$model->password = $profile->password_profile;
						$model->setPassword($model->password);										
						$model->generateAuthKey();
						$model->save(false);
					
					}
				}
			}			
           // print_R($profile->errors);die;
            $profile->save(false);    
            \Yii::$app->controller->goBack();

         } 
         else 
         {  
			if(!$this->isMobile()){ 	 
				return $this->render('profile', ['model' => $model,'profile' => $profile]);
			} else {			  
                return $this->render('mobile/profile',['model' => $model,'profile' => $profile ]);  
			}	
        }
    }
}