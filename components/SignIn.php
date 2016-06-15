<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\Controller;
use app\models\LoginForm;

class SignIn extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {

        $model = new LoginForm();	    
		
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			if(isset(Yii::$app->session['qard']) && Yii::$app->session['qard'] != '' ){
				\Yii::$app->controller->redirect(['qard/publish','id'=>Yii::$app->session['qard']]);
			}
			else
				\Yii::$app->controller->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
	}
}