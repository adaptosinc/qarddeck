<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\Controller;
use app\models\User;
use app\models\UserProfile as Profile;

class SearchWidget extends Widget
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
     return $this->render('search');
			/* if($this->isMobile()){ 	 
				return $this->render('search');		
			  } else {			  
                return $this->render('mobile/search');  
			}	 */  
        
    }
}