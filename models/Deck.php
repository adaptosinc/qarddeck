<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deck".
 *
 * @property integer $deck_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $deck_privacy
 * @property string $url
 * @property string $bg_image
 * @property string $title
 * @property string $description
 *
 * @property Privacy $deckPrivacy
 * @property DeckComment[] $deckComments
 * @property DeckPermissions[] $deckPermissions
 * @property DeckTags[] $deckTags
 * @property QardDeck[] $qardDecks
 */
class Deck extends \yii\db\ActiveRecord
{
	public $cover_image;
   /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deck';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','cover_image'], 'required'],
			[['bg_image'],'safe'],
            [['user_id', 'status', 'deck_privacy'], 'integer'],
            [['url','title', 'description'], 'string'],
			['bg_image','file'],
            [['deck_privacy'], 'exist', 'skipOnError' => true, 'targetClass' => Privacy::className(), 'targetAttribute' => ['deck_privacy' => 'privacy_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deck_id' => 'Deck ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'deck_privacy' => 'Deck Privacy',
            'url' => 'Url',
            'bg_image' => 'Bg Image',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeckPrivacy()
    {
        return $this->hasOne(Privacy::className(), ['privacy_id' => 'deck_privacy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeckComments()
    {
        return $this->hasMany(DeckComment::className(), ['deck_id' => 'deck_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeckPermissions()
    {
        return $this->hasMany(DeckPermissions::className(), ['deck_id' => 'deck_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeckTags()
    {
        return $this->hasMany(DeckTags::className(), ['deck_id' => 'deck_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQardDecks()
    {
        return $this->hasMany(QardDeck::className(), ['deck_id' => 'deck_id']);
    }
}
