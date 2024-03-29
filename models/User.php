<?php

namespace app\models;
//&eea+D_!,SeM
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\UserProfile;
use yii\db\Query;
use yii\db\Command;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
  * @property string $login_type
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $verify_password;
    public $password;
    public $firstname;
    public $profile_photo;	
   
    public $isPublicEmail;
    public $showEmail;
	public $website;
	public $bio;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        
        return [
			['role', 'default', 'value' => 'user'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username','email','password','verify_password'],'required'],
            [['username'],'unique'],
            ['email', 'email'],            
            ['verify_password', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
	$profile = UserProfile::find()->where(['user_id'=>$id])->one();
    $user = static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
	//Defaults first
	$user->firstname = "";
	$user->profile_photo = Yii::$app->homeUrl."images/avatar-lg.png";
	$user->isPublicEmail = 0;
	$user->showEmail = '';//$user->email;
	$user->website = '---';
	$user->bio = 'Hey there, I am using Qarddeck. Its Awesome!!';	
	if($user){
        if(!empty($profile->firstname))
			$user->firstname= $profile->firstname.' '.$profile->lastname;
		
        if(!empty($profile->profile_photo))
            $user->profile_photo = $profile->profile_photo;
		
        if($profile->isEmailEnabled!=0){
			$user->isPublicEmail=1;
            $user->showEmail= $profile->display_email;//$user->email;
		}
		if($profile->display_url != '')
			$user->website = $profile->display_url; 
		if($profile->short_description != '')
			$user->bio = $profile->short_description;
	}
	return $user;

    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
       // echo "here";die;
		//echo "gere::".$password;echo Yii::$app->security->generatePasswordHash($password);die;
         $this->password_hash = Yii::$app->security->generatePasswordHash($password);
		
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /*
     * to check whether id is already present in db or not
     */
    public function checkId($username){
		return User::find()->where(['username'=>$username])->one();	
    }
	
	/**
	 * Check if admin or not
	 */
	 public function isAdmin(){
		 
		 if(\Yii::$app->user->id && \Yii::$app->user->identity->role == 'admin')
			 return true;
		 else
			 return false;
	 }
	 
	 
	 
	public function getUserqardCount()
    {
		
		$connection = Yii::$app->getDb(); 
		$command = $connection->createCommand("SELECT count(*) as qardcount FROM `qard` where `user_id` = '".$this->id."' and  `status` = '1'");
	
		$activities = $command->queryOne();	
		return $userqardcount  = $activities['qardcount'];
		
    }
	
	public function getUserlikeCount()
    {
		
		 $connection = Yii::$app->getDb(); 
		$command = $connection->createCommand("SELECT count(*) as liked FROM `qard` q , `qard_user_activity` qu where q.`user_id` = '".$this->id."' and  q.`status` = '1' and q.`qard_id` = qu.`qard_id` and qu.`activity_type` ='like'");
	
		$activities = $command->queryOne();	
		return $userlikedcount  = $activities['liked'];
		
    }
	
	public function getUserbookmarkCount()
    {
		
		 $connection = Yii::$app->getDb(); 
		$command = $connection->createCommand("SELECT count(*) as bookmark FROM `qard` q , `qard_user_activity` qu where q.`user_id` = '".$this->id."' and  q.`status` = '1' and q.`qard_id` = qu.`qard_id` and qu.`activity_type` ='bookmark'");
	
		$activities = $command->queryOne();	
		return $userbookmarkcount  = $activities['bookmark'];
		
    }
	
	public function getUsershareCount()
    {
		
		 $connection = Yii::$app->getDb(); 
		$command = $connection->createCommand("SELECT count(*) as share FROM `qard` q , `qard_user_activity` qu where q.`user_id` = '".$this->id."' and  q.`status` = '1' and q.`qard_id` = qu.`qard_id` and qu.`activity_type` ='share'");
	
		$activities = $command->queryOne();	
		return $usersharecount  = $activities['share'];
		
    }
	
	public function getFollowingCount()
    {
		
		 $connection = Yii::$app->getDb(); 
		$command = $connection->createCommand("SELECT count(*) as count FROM follower where `user_id` = '".$this->id."' ");
	
		$activities = $command->queryOne();	
		return $usersharecount  = $activities['count'];
		
    }
	
	public function getFollowerCount()
    {
		
		 $connection = Yii::$app->getDb(); 
		$command = $connection->createCommand("SELECT count(*) as count FROM follower where `follower_id` = '".$this->id."' ");
	
		$activities = $command->queryOne();	
		return $usersharecount  = $activities['count'];
		
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
    }	
	
	public function getFindfollowuser($followerid)
    {			
		if(isset($followerid) && !empty($followerid))
		{
			$query = new Query;			
			$query->select(['*'])
				->from('follower')
				->where(['follower_id' =>$followerid,'user_id'=>Yii::$app->user->id ]);
			$command = $query->createCommand();
			$activities = $command->queryAll();
		}
		
		if(!empty($activities) && isset($activities))
			return 1;
		else
			return 0;
    }
	
}