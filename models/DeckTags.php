<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deck_tags".
 *
 * @property integer $dt_id
 * @property integer $deck_id
 * @property integer $tag_id
 *
 * @property Deck $deck
 * @property Tags $tag
 */
class DeckTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deck_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deck_id', 'tag_id'], 'required'],
            [['deck_id', 'tag_id'], 'integer'],
            [['deck_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deck::className(), 'targetAttribute' => ['deck_id' => 'deck_id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tag_id' => 'tag_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dt_id' => 'Dt ID',
            'deck_id' => 'Deck ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeck()
    {
        return $this->hasOne(Deck::className(), ['deck_id' => 'deck_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['tag_id' => 'tag_id']);
    }
}
