<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $profile_id
 * @property integer $user_id
 * @property integer $profile_status
 * @property string $firstname
 * @property string $lastname
 * @property string $profile_url
 * @property string $profile_photo
 * @property string $short_description
 * @property string $display_url
 * @property string $display_email
 * @property string $profile_bg_image
 * @property string $bg_properties
 * @property integer $profile_privacy
 *
 * @property User $user
 * @property Privacy $profilePrivacy
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'profile_status', 'profile_privacy'], 'integer'],
            [['profile_url', 'short_description', 'display_url', 'profile_bg_image', 'bg_properties'], 'string'],
            [['firstname', 'lastname', 'profile_photo', 'display_email'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['profile_privacy'], 'exist', 'skipOnError' => true, 'targetClass' => Privacy::className(), 'targetAttribute' => ['profile_privacy' => 'privacy_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profile_id' => 'Profile ID',
            'user_id' => 'User ID',
            'profile_status' => 'Profile Status',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'profile_url' => 'Profile Url',
            'profile_photo' => 'Profile Photo',
            'short_description' => 'Short Description',
            'display_url' => 'Display Url',
            'display_email' => 'Display Email',
            'profile_bg_image' => 'Profile Bg Image',
            'bg_properties' => 'Bg Properties',
            'profile_privacy' => 'Profile Privacy',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfilePrivacy()
    {
        return $this->hasOne(Privacy::className(), ['privacy_id' => 'profile_privacy']);
    }
}
