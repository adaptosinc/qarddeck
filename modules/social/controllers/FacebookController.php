<?php

namespace app\modules\social\controllers;

class FacebookController extends \yii\web\Controller
{
    public function actionAuth()
    {
        return $this->render('auth');
    }

}
