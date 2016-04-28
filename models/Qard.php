<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qard".
 *
 * @property integer $qard_id
 * @property integer $user_id
 * @property integer $qard_theme
 * @property integer $qard_privacy
 * @property integer $status
 * @property string $title
 * @property string $url
 * @property string $description
 * @property string $bg_image
 *
 * @property User $user
 * @property Privacy $qardPrivacy
 * @property Theme $qardTheme
 * @property QardComments[] $qardComments
 * @property QardDeck[] $qardDecks
 * @property QardPermissions[] $qardPermissions
 */
class Qard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qard';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'qard_theme', 'qard_privacy', 'status', 'title', 'url'], 'required'],
            [['user_id', 'qard_theme', 'qard_privacy', 'status'], 'integer'],
            [['title', 'url', 'description', 'bg_image'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['qard_privacy'], 'exist', 'skipOnError' => true, 'targetClass' => Privacy::className(), 'targetAttribute' => ['qard_privacy' => 'privacy_id']],
            [['qard_theme'], 'exist', 'skipOnError' => true, 'targetClass' => Theme::className(), 'targetAttribute' => ['qard_theme' => 'theme_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qard_id' => 'Qard ID',
            'user_id' => 'User ID',
            'qard_theme' => 'Qard Theme',
            'qard_privacy' => 'Qard Privacy',
            'status' => 'Status',
            'title' => 'Title',
            'url' => 'Url',
            'description' => 'Description',
            'bg_image' => 'Bg Image',
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
    public function getQardPrivacy()
    {
        return $this->hasOne(Privacy::className(), ['privacy_id' => 'qard_privacy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQardTheme()
    {
        return $this->hasOne(Theme::className(), ['theme_id' => 'qard_theme']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQardComments()
    {
        return $this->hasMany(QardComments::className(), ['qard_id' => 'qard_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQardDecks()
    {
        return $this->hasMany(QardDeck::className(), ['qard_id' => 'qard_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQardPermissions()
    {
        return $this->hasMany(QardPermissions::className(), ['qard_id' => 'qard_id']);
    }
}
