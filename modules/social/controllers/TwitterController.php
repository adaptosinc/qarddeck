<?php

namespace app\modules\social\controllers;

use Yii;
use app\libraries\twitter\Twitteroauth;// call twitter library to  get authorize
use app\models\User;
use app\models\UserProfile as Profile;

class TwitterController extends \yii\web\Controller
{
    
    public $CONSUMER_KEY,$CONSUMER_SECRET,$OAUTH_CALLBACK,$servername,$base_url;
    
    public function init(){      
        //$this->CONSUMER_KEY='VJPyNIpFA3BxklMznstgmAYo1';// app id from twitter app
        //$this->CONSUMER_SECRET='XBAv492XUtDY4SnjbxGcysrHZPMbGzhkMCdz1M65ICEy7ogY5Q'; // app secret key from twitter app
		
	  
        $this->CONSUMER_KEY='xo4tPpREtcalKb2XheYxocB6P';// ARIVAZAHGAN app id from twitter app
        $this->CONSUMER_SECRET='G8aEtlTCB1hMPqC2qyjKtGJQxhl7tlprrUqyFthp57FJNoE7wi'; //  ARIVAZAHGAN app secret key from twitter app
		
		
        $this->base_url=Yii::$app->request->baseUrl;  //base url
        //$this->servername=  filter_input(INPUT_SERVER, 'SERVER_NAME');  //server name of working server
        $this->servername = $_SERVER['HTTP_HOST']; 
        $this->OAUTH_CALLBACK= 'http://'.$this->servername.$this->base_url.'/social/twitter/redirect-url';
    }
    
    
     /*
     * to disconnect
     * @return index page
     */
    public function actionDisTwitter(){
         $id =  \Yii::$app->user->id;
        $model = User::find()->where(['id'=>$id])->one();
        $profile = Profile::find()->where(['user_id'=>$id])->one();
        $profile->tw_status = 0;
	$profile->save();
	     return $this->redirect(['../site/index']);       
    }

    /*
     * to get access token 
     * @retrun it sets the session to get access token in next phase
     */
    public function actionSignin(){
	
	$session = Yii::$app->session;	
	$connection = new Twitteroauth($this->CONSUMER_KEY,$this->CONSUMER_SECRET );//passing key and secret key 
	$request_token = $connection->getRequestToken($this->OAUTH_CALLBACK);// to get access token
	
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
	    Yii::$app->getSession()->setFlash('error', "Error connecting to twitter! try again later!");
	    return $this->redirect(['../site/index']);		
	}      
   }
   
   /*
    * it gets the userdetails and store in db
    * @return : fail return error : success then  redirect to home page
    */
   
   public function actionRedirectUrl() {
     
       $session = Yii::$app->session;
       //Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
       $connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $session->get('token_key') , $session->get('token_secret'));
       $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
       if($connection->http_code == '200'){            
            //Redirect user to twitter
            $_SESSION['status'] = 'verified';
            $_SESSION['request_vars'] = $access_token;		
            //Insert user into the database
            $user_info = json_decode(json_encode($connection->get('account/verify_credentials')),true);			
            $status=$this->insertRecord($user_info);
			
            if(!empty($status->errors)){ 
                //pass errors status	
                return $this->redirect(['../site/index']);
            }else{				 
                Yii::$app->user->login($status, '3600*24*30');   							
				$qard_id = Yii::$app->session['qard_id'];
				if(isset($qard_id) && !empty($qard_id))
				{
					return $this->redirect(['../qard/preview-qard?qard_id='.$qard_id]);
				} else{
					return $this->redirect(['../site/index']);
				}
			   
            }
	} else{	    
            Yii::$app->getSession()->setFlash('error', "error, try again later!");
            return $this->redirect(['../site/login']);
	}
   }
   /*
     * to check and insert into database
     * @result array name,email,fd id etc
     * @return redirect : fail to  model error   : success true
     */
   public function insertRecord($result){
       
	$model=new User();
	$profile=new Profile();
       
	$model->username='tw_'.$result['id'];
	//$model->email=$result['email'];
	$model->password=$result['id'];
	//to check already present or not
	 $user = User::find()->where(['username'=>$model->username])->one();
	if($user){ //yes   
		$profile = Profile::find()->where(['user_id'=>$user->id])->one();		
		$profile->profile_photo = $result['profile_image_url'];
		$profile->update();
	    return $user;
	}
	 
	$model->created_at=time();
	$model->updated_at=time();
	$model->verify_password=$result['id'];
	$model->setPassword($model->password);
	$model->generateAuthKey();	
	$model->login_type = "twitter";

	//if($model->validate()){
	    if($model->save(false)){
		$profile->user_id=$model->id;
		$profile->firstname=$result['name'];
		$profile->profile_photo = $result['profile_image_url'];
		//$profile->lastname=$result['last_name'];
		//$profile->display_email=$result['email'];
		if($profile->save()){
		    $user = User::find()->where(['id'=>$model->id])->one();		    
		    return $user;
		}
	    }
	//}else{
	//    return $model;
	//}
   }   
     /*
     * to get access token 
     * @retrun it sets the session to get access token in next phase
     */
    public function actionConnecttwitter(){
        $session = Yii::$app->session;	
	$connection = new Twitteroauth($this->CONSUMER_KEY,$this->CONSUMER_SECRET );//passing key and secret key 
	$request_token = $connection->getRequestToken($this->OAUTH_CALLBACK);// to get access token
	
            $connection = new Twitteroauth($this->CONSUMER_KEY,$this->CONSUMER_SECRET );//passing key and secret key 
            $this->OAUTH_CALLBACK= 'http://'.$this->servername.$this->base_url.'/social/twitter/redirect-userurl';
            $request_token = $connection->getRequestToken($this->OAUTH_CALLBACK);// to get access token
           //Received token info from twitter
            $session->set('token_key',$request_token['oauth_token']);
            $session->set('token_secret', $request_token['oauth_token_secret']);
            
            $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
            header('Location: ' . $twitter_url); 
	    exit(0);
        
    }
   /*
    * it gets the userdetails and store in db
    * @return : fail return error : success then  redirect to home page
    */
   
   public function actionRedirectUserurl() {
	   
	   echo "Error Block 1";
	   exit;
	   
     
       $session = Yii::$app->session;
       //Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
       $connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $session->get('token_key') , $session->get('token_secret'));
       $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($connection->http_code == '200'){            
            //Redirect user to twitter
            $_SESSION['status'] = 'verified';
            $_SESSION['request_vars'] = $access_token;

            //Insert user into the database
            $user_info = json_decode(json_encode($connection->get('account/verify_credentials')),true); 
            $status=$this->insertUserUrlRecord($user_info);
            if(!empty($status->errors)){
                //pass errors status
                return $this->redirect(['../site/index']);
            }else{     
            	         
                Yii::$app->session->setFlash('twitter-success', 'You are successfully connected with twitter..');  
                return $this->redirect(['../site/index']);                
            }
	}else{	    
		Yii::$app->getSession()->setFlash('error', "error, try again later!");
		return $this->redirect(['../site/login']);
	}
   }
    /*
     * to check and insert into database
     * @result array name,email,fd id etc
     * @return redirect : fail to  model error   : success true
     */
   public function insertUserUrlRecord($result){
       
        $id =  \Yii::$app->user->id;
        $model = User::find()->where(['id'=>$id])->one();
        $profile = Profile::find()->where(['user_id'=>$id])->one();
        
        $profile->profile_bg_image= $result['profile_background_image_url'];
		$profile->profile_photo = $result['profile_image_url'];
        $profile->tw_status = 1;
		$profile->save();
		return $profile;	
   }  
    
}
