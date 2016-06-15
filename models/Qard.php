<?php

namespace app\models;

use Yii;

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
        return $this->hasMany(QardDeck::className(), ['qard_id' => 'qard_id']);
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
	
	public function getQardHtml($single=null){
		
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
						if($block->link_image != ''){
								
								$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
								$img_block_style .= 'background-size: cover;';
						}
							
						$img_block_style .= 'min-height:'.$theme['height'].'px;';
						$img_block_style .= 'height:auto;';
						
					//overlay block styles
						$overlay_block_style .= 'opacity:'.$theme['div_opacity'].';';
						$overlay_block_style .= 'background-color:'.$theme['div_bgcolor'].';';
						$overlay_block_style .= 'min-height:'.$theme['height'].'px;';
						$overlay_block_style .='height:auto;';
						
						$text_block_style .= 'min-height:'.$theme['height'].'px;';
						$text_block_style .='height:auto;overflow:hidden;';
				}
				///////////////////////////
				$str .= '<div class="bgimg-block" style="'.$img_block_style.'" >
				<div class="bgoverlay-block" style="'.$overlay_block_style.'">
				<div class="text-block" style="'.$text_block_style.'">';
				$str .= $block->text;
				$str .= '</div></div></div>';

			}	
		$str .= '		</div>
				</div>
			<div class="qard-bottom">
				<ul class="qard-tags">
					<li class="pull-left">#tag#tag#tag</li>
					<li class="pull-right">x days ago</li>
				</ul>
				<h4>Author Full name</h4>
				<ul class="social-list">
					<li><a href=""><img src="'.\Yii::$app->homeUrl.'images/heart.png" alt=""><br />500</a></li>
					<li><a href=""><img src="'.\Yii::$app->homeUrl.'images/comment-dark.png" alt=""><br />500</a></li>
					<li><a href=""><img src="'.\Yii::$app->homeUrl.'images/certify.png" alt=""><br />500</a></li>
					<li><a href=""><img src="'.\Yii::$app->homeUrl.'images/share.png" alt=""><br />500</a></li>
				</ul>
			</div>
			</div>';	
				
		return $str;
		
			}	
	
	}
	public function getQardHtml1(){
		
		$str = '<div class="col-sm-4 col-md-4 grid-item" >
				<div>
					<div>';
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
						if($block->link_image != ''){
								
								$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
								$img_block_style .= 'background-size: cover;';
						}
							
						//$img_block_style .= 'min-height:'.$theme['height'].'px;';
						//$img_block_style .= 'height:auto;';
						
					//overlay block styles
						$overlay_block_style .= 'opacity:'.$theme['div_opacity'].';';
						$overlay_block_style .= 'background-color:'.$theme['div_bgcolor'].';';
						//$overlay_block_style .= 'min-height:'.$theme['height'].'px;';
						//$overlay_block_style .='height:auto;';
						
						//$text_block_style .= 'min-height:'.$theme['height'].'px;';
						$text_block_style .='overflow:hidden;';
				}
				///////////////////////////
				$str .= '<div class="bgimg-block" style="'.$img_block_style.'" >
				<div class="bgoverlay-block" style="'.$overlay_block_style.'">
				<div class="text-block" style="'.$text_block_style.'">';
				$str .= $block->text;
				$str .= '</div></div></div>';

			}	
		$str .= '		</div>
				</div>
			<div class="qard-bottom">
				<ul class="qard-tags">
					<li class="pull-left">#tag#tag#tag</li>
					<li class="pull-right">x days ago</li>
				</ul>
				<h4>Author Full name</h4>
				<ul class="social-list">
					<li><a href=""><img src="'.\Yii::$app->homeUrl.'images/heart.png" alt=""><br />500</a></li>
					<li><a href=""><img src="'.\Yii::$app->homeUrl.'images/comment-dark.png" alt=""><br />500</a></li>
					<li><a href=""><img src="'.\Yii::$app->homeUrl.'images/certify.png" alt=""><br />500</a></li>
					<li><a href=""><img src="'.\Yii::$app->homeUrl.'images/share.png" alt=""><br />500</a></li>
				</ul>
			</div>
			</div>';	
				
		return $str;
		
	}		
	else
		return '';
	}
}
