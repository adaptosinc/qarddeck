<?php

namespace app\modules\social\controllers;

use yii;
use app\libraries\Twitteroauth;
use app\models\User;
use app\models\UserProfile as Profile;

class TwitterController extends \yii\web\Controller
{
    
    public $CONSUMER_KEY='VJPyNIpFA3BxklMznstgmAYo1';
    public $CONSUMER_SECRET='XBAv492XUtDY4SnjbxGcysrHZPMbGzhkMCdz1M65ICEy7ogY5Q';
    public $OAUTH_CALLBACK='http://localhost/qarddeck/web/social/twitter/redirect-url';


    public function actionSignin(){
	
	
       
	$session = Yii::$app->session;
	
       $connection = new Twitteroauth($this->CONSUMER_KEY,$this->CONSUMER_SECRET );
       
       $request_token = $connection->getRequestToken($this->OAUTH_CALLBACK);
       //Received token info from twitter
	$session->set('token_key',$request_token['oauth_token']);
	$session->set('token_secret', $request_token['oauth_token_secret']);
       
       if($connection->http_code == '200')
	{
		//redirect user to twitter
		$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
		header('Location: ' . $twitter_url); 
		exit(0);
	}else{
	    Yii::$app->getSession()->setFlash('error', "error connecting to twitter! try again later!");
	    return $this->redirect(['../site/login']);
		
	}
      
   }
   
   public function actionRedirectUrl() {
       
       $session = Yii::$app->session;
       //Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
	$connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $session->get('token_key') , $session->get('token_secret'));
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($connection->http_code == '200')
	{
		//Redirect user to twitter
		$_SESSION['status'] = 'verified';
		$_SESSION['request_vars'] = $access_token;
		
		//Insert user into the database
		$user_info = json_decode(json_encode($connection->get('account/verify_credentials')),true); 
		$this->insertRecord($user_info);
		
		
		//header('Location: index.php');
	}else{
	    
		Yii::$app->getSession()->setFlash('error', "error, try again later!");
		return $this->redirect(['../site/login']);
	}
       
       
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
}
