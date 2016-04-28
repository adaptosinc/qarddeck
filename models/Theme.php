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
            [['theme_type', 'theme_properties'], 'required'],
            [['theme_type'], 'integer'],
            [['theme_properties'], 'string'],
            [['theme_name'], 'string', 'max' => 255],
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
