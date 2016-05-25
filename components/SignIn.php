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
            \Yii::$app->controller->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
	}
}