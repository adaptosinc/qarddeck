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

    public function run()
    {
        $id =  \Yii::$app->user->id;
        $model = User::find()->where(['id' => $id])->one();		
        $profile = Profile::find()->where(['user_id' => $id])->one();	
        
        
  
        if($profile->load(Yii::$app->request->post())){
            
            $newProfile = Profile::find()->where(['user_id' => $id])->one();
	
				$profile->profile_photo = \Yii::$app->homeUrl.$newProfile->temp_image; 
			
            $profile->validate();
            if($profile->errors || $model->errors){
                    foreach($model->errors as $error){
                            \Yii::$app->getSession()->setFlash('profile_update_error', $error[0]);
                    }
                    foreach($profile->errors as $error){
                            \Yii::$app->getSession()->setFlash('profile_update_error', $error[0]);
                    }
                    
                    return $this->render('profile', [
                             'model' => $model,
                             'profile' => $profile
                     ]);
            };
	
            if($profile->password_profile)
            {
                $model->password = $profile->password_profile;
                $model->setPassword($model->password );
                $model->generateAuthKey();
                $model->save(false);
            }	    
           // print_R($profile->errors);die;
            $profile->save();    
            \Yii::$app->controller->goBack();

         } 
         else 
         {                        
            return $this->render('profile', [
                    'model' => $model,
                    'profile' => $profile
            ]);
        }
    }
}