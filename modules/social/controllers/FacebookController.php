<?php

namespace app\modules\social\controllers;

use Yii;
use app\models\User;
use app\models\UserProfile as Profile;


class FacebookController extends \yii\web\Controller
{
    public $client_id,$client_secret,$callback_url,$servername,$base_url;
    
    public function init() {
	$this->client_id='1142793035779809';//app id of facebook
	$this->client_secret='8dc64cf509704e2cd4e2dcd5ed1a1aea';//app secret key of facebook
	$this->base_url=Yii::$app->request->baseUrl;  
	$this->servername=  filter_input(INPUT_SERVER, 'SERVER_NAME');  //server name of working server
	$this->callback_url='http://'.$this->servername.$this->base_url.'/social/facebook/get-token';// callback url to get access token and other information
	
    }
    
    
    /*
     * redirect to facebook page
     */
    public function actionIndex(){
	
	
	$url='https://www.facebook.com/dialog/oauth?client_id='.$this->client_id.'&redirect_uri='.$this->callback_url.'&scope=email';
	header('Location:'.$url);
	exit(0);
	
    }
    /*
     * return url to get access token 
     * @code string get the temporary access token
     * @return url to access to token
     */
    public function requestForToken($code){
	$url=urlencode($this->callback_url);
	return $token_url = "https://graph.facebook.com/oauth/access_token?"."client_id=".$this->client_id."&redirect_uri=".$url."&client_secret=".$this->client_secret."&code=". $code;
    }
    
    /*
     * after redirect from  login page of facebook return tempaorary access token
     * @code temporary access token
     * @return redirect : fail to  login page  : success to home page
     */
    public function actionGetToken($code)
    {
	

	$model=new User();
	
	$token_url = $this->requestForToken($code);
	
	$response=$this->curlExecutionHttps($token_url);
	$params = null;
	
	parse_str($response, $params);//convert string to array to get access_token
	
	$token_url='https://graph.facebook.com/me?fields=id,email,first_name,last_name&access_token='.$params['access_token'];
	
	$result=json_decode($this->curlExecutionHttps($token_url),true);
	
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
	exit(0);
	
    }
    
    /*
     * to check and insert into database
     * @result array name,email,fd id etc
     * @return redirect : fail to  login page  : success to home page
     */
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
	$model->email=$result['email'];
	$user = User::find()->where(['email'=>$model->email])->one();
	if($user){ //yes   
	   
	    Yii::$app->getSession()->setFlash('error', "Email-id Already Used!...");	   
	    return $this->redirect(['../site/login']);
	    
	}
	$model->created_at=time();
	$model->updated_at=time();
	$model->verify_password=$result['id'];
	$model->setPassword($model->password);
	$model->generateAuthKey();	
	
	if($model->validate()){
	    if($model->save(false)){
		$profile->user_id=$model->id;
		$profile->firstname=$result['first_name'];
		$profile->lastname=$result['last_name'];
		$profile->display_email=$result['email'];
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
   
   
   /*
    * to execute curl request for the page
    */
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
