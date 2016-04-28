<?php

namespace app\modules\blocks\controllers;

use yii;

class BlocksController extends \yii\web\Controller
{
    public function actionCreate()
    {
	
	
        return $this->render('create');
    }

}
