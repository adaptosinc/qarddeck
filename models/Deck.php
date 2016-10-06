<?php

namespace app\models;

use Yii;
use app\models\Qard;

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
								  
		
		$qardcount = $this->deckqardCount;
		$bookmarkcount = $this->deckqardbookmarkCount;
		$sharecount = $this->deckqardshareCount;
		$likecount = $this->deckqardlikeCount;
		$commentscount = $this->deckqardcommentCount;
		
				
		$html = '<div class="grid-item"><div class="qard-content qard5 deckid" id="deck'.$this->deck_id.'"><div id="deck_'.$this->deck_id.'">';
		$html .= '<img  src="'.$this->bg_image.'" />';
		$html .= '</div>';
		//deck bottom
		
		$html .='<div class="qard-overlay">
					<div class="qard-share">
						<h4><button class="btn btn-warning">View Deck</button></h4>
						<ul>
							<li><img alt="" src="'.Yii::$app->homeUrl.'images/comments_icon.png"><span>'.$commentscount.'</span></li>
							<li><img alt="" src="'.Yii::$app->homeUrl.'images/share_icon.png"><span>'.$sharecount.'</span></li>
							<li><img alt="" src="'.Yii::$app->homeUrl.'images/bookmark_icon.png"><span>'.$bookmarkcount.'</span></li>
							<li><img alt="" src="'.Yii::$app->homeUrl.'images/heart_icon.png"><span>'.$likecount.'</span></li>
						</ul>
					</div>
				</div></div>';
												
												
												
												
		$html .= '
				<div class="qard-bottom">
					<ul class="qard-tags">
					<li class="pull-left"><img src="'.$this->userProfile->profile_photo.'" alt="" width="15px" height="15px" style="border-radius:50%;">'.$this->userProfile->fullname.'</li>
					<li class="pull-right">'.$diff.'</li>
				</ul>
				<h3 class="col-sm-9 col-md-9" >'.$this->title.'</h3>
					<span class="col-sm-3 col-md-3 pull-right"><img  alt="" src="'.Yii::$app->homeUrl.'images/qard-stream_icon.png">&nbsp;'.$qardcount.'</span>
				
				</div></div>';
				
	
		
		return $html;
		
		
	}	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getDeckqardCount()
    {
		/* $qard_decks = $this->qardDecks;
		$count = count($qard_decks); */
		
		$connection = Yii::$app->getDb(); 
		$command = $connection->createCommand('SELECT count(*) as qardcount FROM `qard_deck` `qd`, `qard` `q` WHERE (`qd`.`deck_id`='.$this->deck_id.') AND (`qd`.`qard_id`= q.`qard_id`) AND (q.`status` != 2 )');
	
		$activities = $command->queryOne();	
		$count = $activities['qardcount'];
		return $count;
		
    }
	
	
	 public function getDeckqardbookmarkCount()
    {
		
		$connection = Yii::$app->getDb(); 
		$command = $connection->createCommand('SELECT count(*) as bookmark FROM `qard_deck` `qd`, `qard_user_activity` `qua`,`qard` `q` WHERE (`qd`.`deck_id`='.$this->deck_id.') AND (`qd`.`qard_id`= qua.`qard_id`) AND (`qua`.`activity_type`="bookmark") AND (`qd`.`qard_id`= q.`qard_id`) AND (q.`status` != 2 )');
	
		$activities = $command->queryOne();	
		return $count_bookmark  = $activities['bookmark'];
		
    }
	
	
	 public function getDeckqardshareCount()
    {
	
		 $connection = Yii::$app->getDb(); 
		$command = $connection->createCommand('SELECT count(*) as share FROM `qard_deck` `qd`, `qard_user_activity` `qua`,`qard` `q` WHERE (`qd`.`deck_id`='.$this->deck_id.') AND (`qd`.`qard_id`= qua.`qard_id`) AND (`qua`.`activity_type`="share") AND (`qd`.`qard_id`= q.`qard_id`) AND (q.`status` != 2 )');
	
		$activities = $command->queryOne();	
		return $count_bookmark  = $activities['share'];
		
    }
	
	public function getDeckqardlikeCount()
    {
		
		 $connection = Yii::$app->getDb(); 
		$command = $connection->createCommand('SELECT count(*) as liked FROM `qard_deck` `qd`, `qard_user_activity` `qua`,`qard` `q` WHERE (`qd`.`deck_id`='.$this->deck_id.') AND (`qd`.`qard_id`= qua.`qard_id`) AND (`qua`.`activity_type`="like") AND (`qd`.`qard_id`= q.`qard_id`) AND (q.`status` != 2 ) ');
	
		$activities = $command->queryOne();	
		return $count_bookmark  = $activities['liked'];
		
    }
	
	public function getDeckqardcommentCount()
    {
		
		 $connection = Yii::$app->getDb(); 
		$command = $connection->createCommand('SELECT count(*) as comments FROM `qard_deck` qd, `qard_comments` qc ,`qard` `q` WHERE qd.deck_id = '.$this->deck_id.' and qd.`qard_id` = qc.`qard_id` AND (`qd`.`qard_id`= q.`qard_id`) AND (q.`status` != 2 ) ');
	
		$activities = $command->queryOne();	
		return $count_comments  = $activities['comments'];
		
    }
	
	public function getDeckCreatedAgo(){
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
