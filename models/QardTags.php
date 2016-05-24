<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qard_tags".
 *
 * @property integer $qt_id
 * @property integer $qard_id
 * @property integer $tag_id
 *
 * @property Qard $qard
 * @property Tags $tag
 */
class QardTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qard_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qard_id', 'tag_id'], 'required'],
            [['qard_id', 'tag_id'], 'integer'],
            [['qard_id'], 'exist', 'skipOnError' => true, 'targetClass' => Qard::className(), 'targetAttribute' => ['qard_id' => 'qard_id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'tag_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qt_id' => 'Qt ID',
            'qard_id' => 'Qard ID',
            'tag_id' => 'Tag ID',
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
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['tag_id' => 'tag_id']);
    }
}
