<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\Controller;
use app\models\User;
use app\models\UserProfile as Profile;

class NewpwdWidget extends Widget
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
			
            if($profile->errors || $model->errors){
                    foreach($model->errors as $error){
                            \Yii::$app->getSession()->setFlash('profile_update_error', $error[0]);
                    }
                    foreach($profile->errors as $error){
                            \Yii::$app->getSession()->setFlash('profile_update_error', $error[0]);
                    }
                                     			  
						return $this->render('newpassword',['model' => $model,'profile' => $profile ]);  					
            };
	
			
				if(!empty($profile->password_profile) && !empty($profile->verify_password_profile) && ($profile->password_profile == $profile->verify_password_profile ))
				{
								
						\Yii::$app->getSession()->setFlash('pwd_success', '<div style="text-align:center" class="text-danger" >Your New Password Has Been Changed Successfully...</div>');				
						$model->password = $profile->password_profile;
						$model->setPassword($model->password);										
						$model->generateAuthKey();
						$model->save(false);
						Yii::$app->getResponse()->redirect("profile")->send();
						return;
				} else 
				{
					\Yii::$app->getSession()->setFlash('newpwd_success', '<div style="text-align:center" class="text-danger" >Invalid Password Match, Please Try Again !!!.</div>');
					
					return $this->render('newpassword', ['model' => $model,'profile' => $profile]);					
				}								
         } 
         else 
         {  	 
			return $this->render('newpassword', ['model' => $model,'profile' => $profile]);				
         }
    }
}