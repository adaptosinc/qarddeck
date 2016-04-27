<?php

namespace app\modules\social\controllers;

use Yii;
use app\models\User;
use app\models\UserProfile as Profile;


class FacebookController extends \yii\web\Controller
{
    public function actionAuth($code)
    {
//        return $this->render('auth');
	$model=new User();
	$profile=new Profile();
	
//	echo "<br><br><br><br><br><br><br><br>";
	
	$url=urlencode('http://localhost/qarddeck/web/social/facebook/auth');
	$token_url = "https://graph.facebook.com/oauth/access_token?"."client_id=1142793035779809&redirect_uri=".$url."&client_secret=8dc64cf509704e2cd4e2dcd5ed1a1aea&code=". $code;
	$response=$this->curlExecutionHttps($token_url);
	$params = null;
	parse_str($response, $params);
	$token_url='https://graph.facebook.com/me?fields=id,email,first_name,last_name&access_token='.$params['access_token'];
	$result=json_decode($this->curlExecutionHttps($token_url),true);
//	redirect()
	$model->username='fb_'.$result['id'];
	$model->email=$result['email'];
	$model->password=$result['id'];
	//to check already present or not
	 $user = User::find()->where(['username'=>$model->username])->one();
	if($user){ //yes   
	    Yii::$app->user->login($user, '3600*24*30');
	    return $this->redirect(['../site/index']);
	}
	$this->insertRecord($result);
	
    }
    public function insertRecord($result){
       
	$model=new User();
	$profile=new Profile();
       
	$model->username='fb_'.$result['id'];
	//$model->email=$result['email'];
	$model->password=$result['id'];
	//to check already present or not
	 $user = User::find()->where(['username'=>$model->username])->one();
	if($user){ //yes   
	    Yii::$app->user->login($user, '3600*24*30');
	    return $this->redirect(['../site/index']);
	}
	$model->created_at=time();
	$model->updated_at=time();
	$model->verify_password=$result['id'];
	$model->setPassword($model->password);
	$model->generateAuthKey();	
	
	if($model->validate()){
	    if($model->save(false)){
		$profile->user_id=$model->id;
		$profile->firstname=$result['name'];
		//$profile->lastname=$result['last_name'];
		//$profile->display_email=$result['email'];
		if($profile->save()){
		    Yii::$app->user->login($model, '3600*24*30');
		    return $this->redirect(['../site/index']);
		}else{
		    Yii::$app->getSession()->setFlash('error', "Unable to store Please try later!");
		    return $this->redirect(['../site/login']);
		}
	    }else{
		Yii::$app->getSession()->setFlash('error', "Unable to store Please try later!");
		return $this->redirect(['../site/login']);
	    }
	   
	}else{
	    
	    Yii::$app->getSession()->setFlash('error', "Unable to store Please try later!");
	    return $this->redirect(['../site/login']);
	}
   }
   
    public function curlExecutionHttps($url){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
          ),
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        
        return $result;
    }

}
