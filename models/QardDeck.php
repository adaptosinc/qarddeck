<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qard_deck".
 *
 * @property integer $qd_id
 * @property integer $qard_id
 * @property integer $deck_id
 *
 * @property Qard $qard
 * @property Deck $deck
 */
class QardDeck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qard_deck';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qard_id', 'deck_id'], 'required'],
            [['qard_id', 'deck_id'], 'integer'],
            [['qard_id'], 'exist', 'skipOnError' => true, 'targetClass' => Qard::className(), 'targetAttribute' => ['qard_id' => 'qard_id']],
            [['deck_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deck::className(), 'targetAttribute' => ['deck_id' => 'deck_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qd_id' => 'Qd ID',
            'qard_id' => 'Qard ID',
            'deck_id' => 'Deck ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQard()
    {
        return $this->hasOne(Qard::className(), ['qard_id' => 'qard_id'])->andWhere(['status'=>1]);;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeck()
    {
        return $this->hasOne(Deck::className(), ['deck_id' => 'deck_id']);
    }
}
