<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qard_block".
 *
 * @property integer $block_id
 * @property integer $qard_id
 * @property integer $theme_id
 * @property integer $status
 * @property integer $is_title
 * @property string $text
 * @property string $extra_text
 * @property string $link_url
 * @property string $link_image
 * @property string $link_document
 * @property string $link_title
 * @property string $link_description
 * @property integer $block_priority
 * @property string $block_name
 * @property string $placeholder_text
 * @property string $help_text
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qard_block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qard_id', 'theme_id', 'status'], 'required'],
            [['qard_id', 'theme_id', 'status', 'is_title', 'block_priority'], 'integer'],
            [['text', 'extra_text', 'link_url', 'link_image', 'link_document', 'link_title', 'link_description', 'placeholder_text', 'help_text'], 'string'],
            [['block_name'], 'string', 'max' => 255],
	    [['link_image'],'file','skipOnEmpty' => true, 'extensions' => 'png, jpg'],
	    [['link_document'],'file','skipOnEmpty' => true, 'extensions' => 'pdf,docx,doc'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'block_id' => 'Block ID',
            'qard_id' => 'Qard ID',
            'theme_id' => 'Theme ID',
            'status' => 'Status',
            'is_title' => 'Is Title',
            'text' => 'Text',
            'extra_text' => 'Extra Text',
            'link_url' => 'Link Url',
            'link_image' => 'Link Image',
            'link_document' => 'Link Document',
            'link_title' => 'Link Title',
            'link_description' => 'Link Description',
            'block_priority' => 'Block Priority',
            'block_name' => 'Block Name',
            'placeholder_text' => 'Placeholder Text',
            'help_text' => 'Help Text',
        ];
    }
}

