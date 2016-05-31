<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "theme".
 *
 * @property integer $theme_id
 * @property integer $theme_type
 * @property string $theme_name
 * @property string $theme_properties
 *
 * @property Qard[] $qards
 */
class Theme extends \yii\db\ActiveRecord
{
	
	public $theme_color_1;
	public $theme_color_2;
	public $theme_color_3;
	public $theme_color_4;
	public $theme_color_5;
	
	public $is_bold;
	public $is_italics;
	public $is_underline;
	
	public $text_align;
	public $text_color;
	public $font_style;

	public $light_text_color;
	public $dark_text_color;
	public $light_link_color;
	public $dark_link_color;
	
	public $overlay_opacity;
	public $overlay_color;
	
	public $block_background_color;
	public $element_highlight_color;
	
	
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'theme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theme_name'], 'required',"on"=>"qard-theme"],
            [['theme_type'], 'integer'],
            [['theme_properties'], 'string'],
            [['theme_name'], 'string', 'max' => 255],
			[['theme_color_1','theme_color_2','theme_color_3','theme_color_4','theme_color_5','is_bold','is_italics','is_underline','text_align','text_color','font_style','light_text_color','dark_text_color','light_link_color','dark_link_color','overlay_opacity','overlay_color','block_background_color','element_highlight_color'] , 'safe'	]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'theme_id' => 'Theme ID',
            'theme_type' => 'Theme Type',
            'theme_name' => 'Theme Name',
            'theme_properties' => 'Theme Properties',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQards()
    {
        return $this->hasMany(Qard::className(), ['qard_theme' => 'theme_id']);
    }
}
