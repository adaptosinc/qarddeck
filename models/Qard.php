<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Command;

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
 * @property QardTags[] $qardTags
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
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'user_id']);
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
    public function getBlocks()
    {
        return $this->hasMany(QardBlock::className(), ['qard_id' => 'qard_id'])->orderBy(['block_priority' => SORT_ASC]);;
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQardDecks()
    {
        return $this->hasOne(QardDeck::className(), ['qard_id' => 'qard_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQardPermissions()
    {
        return $this->hasMany(QardPermissions::className(), ['qard_id' => 'qard_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQardTags()
    {
        return $this->hasMany(QardTags::className(), ['qard_id' => 'qard_id']);
    }
	
	public function getQardHtml($type=null){
		
		$str = '<div class="grid-item">
				<div class="qard-content" id="qard'.$this->qard_id.'">
				<div id="add-block'.$this->qard_id.'" class="qard-div ">';
			$blocks = $this->blocks;
			if(isset($blocks) && !empty($blocks)){
			//	print_R($blocks);die;
			foreach($blocks as $block){
				////get the inline styles///
				$img_block_style = '';
				$overlay_block_style = '';
				$text_block_style = '';
				$theme = $block->theme->theme_properties;
				$theme = unserialize($theme);
				if(isset($theme)){
					//img block styles
						$img_block_style .= 'opacity:'.$theme['image_opacity'].';';
/* 						if($block->link_image != ''){
								
								$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
								$img_block_style .= 'background-size: cover;';
						} */
						if($theme['div_bgcolor'] != '')
							$img_block_style .= 'background-color:'.$theme['div_bgcolor'].';';	
						$img_block_style .= 'height:'.$theme['height'].'px;';
						//$img_block_style .= 'height:auto;';
						
					//overlay block styles
						$overlay_block_style .= 'opacity:'.$theme['div_opacity'].';';
						if(isset($theme['div_overlaycolor']) && $theme['div_overlaycolor']!='')
							$overlay_block_style .= 'background-color:'.$theme['div_overlaycolor'].';';
						$overlay_block_style .= 'height:'.$theme['height'].'px;';
						//$overlay_block_style .='height:auto;';
						
						$text_block_style .= 'height:'.$theme['height'].'px;';
						$text_block_style .='overflow:hidden;';
						//$text_block_style .='height:auto;';
				}
				if(!isset($theme['data_style_qard']))
					$theme['data_style_qard'] = "line";
				///////////////////////////
				$str .= '<div class="bgimg-block '.$theme['data_style_qard'].'" style="'.$img_block_style.'" >
				<div class="bgoverlay-block" style="'.$overlay_block_style.'">
				<div class="text-block" style="'.$text_block_style.'">';
				$str .= $block->text;
				$str .= '</div></div></div>';

			}	
		$str .= '</div>
					<div class="qard-overlay">
						<div class="qard-share">
							<h4><button class="btn btn-warning">View Qard</button></h4>
							<ul>
								<li><img src="'.Yii::$app->homeUrl.'images/comments_icon.png" alt=""><span>'.$this->getCommentsCount().'</span></li>
								<li><img src="'.Yii::$app->homeUrl.'images/share_icon.png" alt=""><span>'.$this->getShareCount().'</span></li>
								<li><img src="'.Yii::$app->homeUrl.'images/bookmark_icon.png" alt=""><span>'.$this->getBookmarkCount().'</span></li>
								<li><img src="'.Yii::$app->homeUrl.'images/heart_icon.png" alt=""><span>'.$this->getLikeCount().'</span></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="qard-bottom">
					<ul class="qard-tags">
					<li class="pull-left"><img src="'.$this->userProfile->profile_photo.'" alt="" width="15px" height="15px" style="border-radius:50%;">'.$this->userProfile->fullname.'</li>
					<li class="pull-right">3 days ago</li>
				</ul>
				<h3>'.$this->title.'</h3>
				</div>
				</div>';	
				
		return $str;
		
			}	
	
	}
	public function getQardHtmlSingle(){
		
		$str = '<div class="grid-item">
				<div class="qard-content" id="qard'.$this->qard_id.'" style="border: 5px solid #fff;">
				<div id="add-block'.$this->qard_id.'" class="qard-div add-block">';
			$blocks = $this->blocks;
			if(isset($blocks) && !empty($blocks)){
			//	print_R($blocks);die;
			foreach($blocks as $block){
				////get the inline styles///
				$img_block_style = '';
				$overlay_block_style = '';
				$text_block_style = '';
				$theme = $block->theme->theme_properties;
				$theme = unserialize($theme);
				if(isset($theme)){
					//img block styles
						$img_block_style .= 'opacity:'.$theme['image_opacity'].';';
/* 						if($block->link_image != ''){
								
								$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
								$img_block_style .= 'background-size: cover;';
						} */
						if($theme['div_bgcolor'] != '')
							$img_block_style .= 'background-color:'.$theme['div_bgcolor'].';';	
						$img_block_style .= 'height:'.$theme['height'].'px;';
						//$img_block_style .= 'height:auto;';
						
					//overlay block styles
						$overlay_block_style .= 'opacity:'.$theme['div_opacity'].';';
						if(isset($theme['div_overlaycolor']) && $theme['div_overlaycolor']!='')
							$overlay_block_style .= 'background-color:'.$theme['div_overlaycolor'].';';
						$overlay_block_style .= 'height:'.$theme['height'].'px;';
						//$overlay_block_style .='height:auto;';
						
						$text_block_style .= 'height:'.$theme['height'].'px;';
						$text_block_style .='overflow:hidden;';
						//$text_block_style .='height:auto;';
				}
				if(!isset($theme['data_style_qard']))
					$theme['data_style_qard'] = "line";
				///////////////////////////
				$str .= '<div class="bgimg-block '.$theme['data_style_qard'].'" style="'.$img_block_style.'" >
				<div class="bgoverlay-block" style="'.$overlay_block_style.'">
				<div class="text-block" style="'.$text_block_style.'">';
				$str .= $block->text;
				$str .= '</div></div></div>';

			}	
		$str .= '		</div>
				</div>
			</div>';	
				
		return $str;
		
			}	
	}
	public function getCommentsCount(){
		$comments = count($this->qardComments);
		return $comments ;
	}
	public function getShareCount(){
		$query = new Query;
		//see if the row already exists or not
		$query->select(['*'])
			->from('qard_user_activity')
			->where(['activity_type' => 'share',
					'qard_id' => $this->qard_id
					]);
		$command = $query->createCommand();
		$activities = $command->queryAll();
		return 	count($activities);	
	}
	public function getLikeCount(){
		$query = new Query;
		//see if the row already exists or not
		$query->select(['*'])
			->from('qard_user_activity')
			->where(['activity_type' => 'like',
					'qard_id' => $this->qard_id
					]);
		$command = $query->createCommand();
		$activities = $command->queryAll();
		return 	count($activities);			
	}
	public function getBookmarkCount(){
		$query = new Query;
		//see if the row already exists or not
		$query->select(['*'])
			->from('qard_user_activity')
			->where(['activity_type' => 'bookmark',
					'qard_id' => $this->qard_id
					]);
		$command = $query->createCommand();
		$activities = $command->queryAll();	
		return 	count($activities);			
	}
	
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getDeckqardCount()
    {
       /*   $query = new Query;
		//see if the row already exists or not
		$query->select(['deck_id'])
			->from('qard_deck')
			->where([
					'qard_id' => $this->qard_id
					]);
			
		$command = $query->createCommand();
		$activities1 = $command->queryOne();	
		
		
		$query->select(['*'])
			->from('qard_deck')
			->where(['deck_id' => $activities1]);
			
			
		$command = $query->createCommand();
		$activities2 = $command->queryAll();	

			
		
		return $activities2;	 */ 
		
		 $qard_decks = $this->getQardDecks();
		return count($qard_decks); 
		
    }
	
	
}
