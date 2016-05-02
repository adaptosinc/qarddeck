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
        if($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())){
            $model->setPassword($model->password);
            $model->save();
            $profile->save();    
            \Yii::$app->controller->goBack();

         } 
         else 
         {                
            \Yii::$app->getSession()->setFlash('prof_error', 'good');             
            return $this->render('profile', [
                    'model' => $model,
                    'profile' => $profile
            ]);
        }
    }
}