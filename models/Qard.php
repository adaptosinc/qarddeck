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
		
		$datetime = $this->last_updated_at;								 
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
		
		$theme = $this->qardTheme;
		$theme_properties = unserialize($theme->theme_properties);
		
		$str = '<div class="grid-item">
				<div class="qard-content qardid" id="qard'.$this->qard_id.'">
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
						if(!isset($theme['data_img_type']))
							$theme['data_img_type'] = "preview";
					//img block styles
						//$img_block_style .= 'opacity:'.$theme['image_opacity'].';';
						if($block->link_image != '' && ($theme['data_img_type'] == 'background' || $theme['data_img_type'] == 'both')){
								
								$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
								$img_block_style .= 'background-size: cover;';
								$data_img_url = \Yii::$app->homeUrl.'uploads/block/'.$block->link_image;
						}
						if($theme['div_bgcolor'] != '')
							$img_block_style .= 'background-color:'.$theme['div_bgcolor'].';';	
						$img_block_style .= 'height:'.$theme['height'].'px;';
						//$img_block_style .= 'height:auto;';
						
					//overlay block styles
						if($block->link_image != '' && ($theme['data_img_type'] == 'background' || $theme['data_img_type'] == 'both')){
							$opacity = $theme_properties['overlay_opacity']/100;
							//$overlay_block_style .= 'opacity:'.$opacity.';';
							//if(isset($theme['div_overlaycolor']) && $theme_properties['div_overlaycolor']!='')
								$overlay_block_style .= 'background-color:'.$theme_properties['overlay_color'].';';								
							
						}
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
					<li class="pull-left"><img src="'.$this->userProfile['profile_photo'].'" alt="" width="15px" height="15px" style="border-radius:50%;">'.$this->userProfile['fullname'].'</li> 
					<li class="pull-right">'.$diff.'</li>
					</ul>
				<h3>'.$this->title.'</h3>
				</div>
				</div>';	
				
				 
			
		return $str;
		
			}	
	
	}
	public function getQardHtmlSingle(){
		
		$theme = $this->qardTheme;
		$theme_properties = unserialize($theme->theme_properties);	
		
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
						if(!isset($theme['data_img_type']))
							$theme['data_img_type'] = "preview";
					//img block styles
						//$img_block_style .= 'opacity:'.$theme['image_opacity'].';';
						if($block->link_image != '' && ($theme['data_img_type'] == 'background' || $theme['data_img_type'] == 'both')){
								
								$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
								$img_block_style .= 'background-size: cover;';
								$data_img_url = \Yii::$app->homeUrl.'uploads/block/'.$block->link_image;
						} 
						if($theme['div_bgcolor'] != '')
							$img_block_style .= 'background-color:'.$theme['div_bgcolor'].';';	
						$img_block_style .= 'height:'.$theme['height'].'px;';
						//$img_block_style .= 'height:auto;';
						
					//overlay block styles
						if($block->link_image != '' && ($theme['data_img_type'] == 'background' || $theme['data_img_type'] == 'both')){
							$opacity = $theme_properties['overlay_opacity']/100;
							//$overlay_block_style .= 'opacity:'.$opacity.';';
							//if(isset($theme['div_overlaycolor']) && $theme_properties['div_overlaycolor']!='')
								$overlay_block_style .= 'background-color:'.$theme_properties['overlay_color'].';';								
							
						}
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
		$qard_decks = $this->getQardDecks();
		return count($qard_decks); 
		
    }
	
	public function getCreatedAgo(){
		$datetime = $this->last_updated_at;								 
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
