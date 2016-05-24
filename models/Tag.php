<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tags".
 *
 * @property integer $tag_id
 * @property string $name
 * @property string $description
 *
 * @property DeckTags[] $deckTags
 * @property QardTags[] $qardTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeckTags()
    {
        return $this->hasMany(DeckTags::className(), ['tag_id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQardTags()
    {
        return $this->hasMany(QardTags::className(), ['tag_id' => 'tag_id']);
    }
    /**
     * 
     * @return all tags
     */
    public function getAllTags() {
	 
	return ArrayHelper::map($this->find()->all(), 'tag_id', 'name');
    }
}
