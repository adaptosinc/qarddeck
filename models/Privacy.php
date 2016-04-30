<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "privacy".
 *
 * @property integer $privacy_id
 * @property string $privacy_type
 * @property string $description
 *
 * @property Deck[] $decks
 * @property Qard[] $qards
 * @property UserProfile[] $userProfiles
 */
class Privacy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'privacy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['privacy_type', 'description'], 'required'],
            [['description'], 'string'],
            [['privacy_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'privacy_id' => 'Privacy ID',
            'privacy_type' => 'Privacy Type',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecks()
    {
        return $this->hasMany(Deck::className(), ['deck_privacy' => 'privacy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQards()
    {
        return $this->hasMany(Qard::className(), ['qard_privacy' => 'privacy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['profile_privacy' => 'privacy_id']);
    }
}
