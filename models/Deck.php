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
 * @property timestamp $created_at
 * @property timestamp $updated_at
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
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'user_id']);
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
	
	public function getTagsHtml()
	{
		$decktags = $this->deckTags;
		$tag_html = '';
		//print_r($decktags);die;
		foreach($decktags as $decktag){
			$tag_html .= "#".$decktag->tag->name; 
		}
		return $tag_html;
	}
	/**
	 * @return html for single deck
	 */
	public function getDeckHtml()
	{
		$html = '<div class="grid-item"><div class="qard-content qard5"><div class="bgimg-block style-block" id="deck_'.$this->deck_id.'">';
		$html .= '<img src="'.$this->bg_image.'" />';
		$html .= '</div></div>';
		//deck bottom
		$html .= '
				<div class="qard-bottom">
					<ul class="qard-tags">
					<li class="pull-left"><img src="'.$this->userProfile->profile_photo.'" alt="" width="15px" height="15px" style="border-radius:50%;">'.$this->userProfile->fullname.'</li>
					<li class="pull-right">3 days ago</li>
				</ul>
				<h3>'.$this->title.'</h3>
				</div></div>';
		
		
		return $html;
	}	
}
