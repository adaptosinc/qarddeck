<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qard_comments".
 *
 * @property integer $qard_comment_id
 * @property integer $parent_id
 * @property integer $qard_id
 * @property integer $user_id
 * @property string $text
 * @property integer $status
 * @property integer $priority
 *
 * @property Qard $qard
 * @property User $user
 */
class QardComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qard_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'text'], 'required'],
            [['parent_id', 'qard_id', 'user_id', 'status', 'priority'], 'integer'],
            [['text'], 'string'],
            [['qard_id'], 'exist', 'skipOnError' => true, 'targetClass' => Qard::className(), 'targetAttribute' => ['qard_id' => 'qard_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qard_comment_id' => 'Qard Comment ID',
            'parent_id' => 'Parent ID',
            'qard_id' => 'Qard ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'status' => 'Status',
            'priority' => 'Priority',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQard()
    {
        return $this->hasOne(Qard::className(), ['qard_id' => 'qard_id']);
    }
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUserProfile()
	{
		return $this->hasOne(UserProfile::className(), ['user_id' => 'user_id']);
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	public function getCreatedAgo(){
		
		  $datetime = $this->created_at;
		  $date = date('M j Y g:i A', strtotime($datetime));
		  $date = new \DateTime($date);
		  $datetime1 = new \DateTime("now"); 
		  $diff = $datetime1->diff($date)->format("%a");
		  if($diff == 0){
			  $diff = 'Today';
		  }else if($diff==1){
			  $diff = '1 day ago';
		  }else{
			  $diff = $diff.' days ago';
		  }
		  
		  return $diff;
	}
}
