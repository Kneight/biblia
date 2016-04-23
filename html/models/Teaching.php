<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teaching".
 *
 * @property integer $id
 * @property integer $primary_language_id
 * @property integer $secondary_language_id
 * @property string $en_title
 * @property string $pt_title
 * @property string $url
 * @property integer $teacher_id
 * @property integer $copyright_id
 * @property string $length
 *
 * @property Copyright $copyright
 * @property Language $primaryLanguage
 * @property Language $secondaryLanguage
 * @property Teacher $teacher
 */
class Teaching extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teaching';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['primary_language_id', 'en_title', 'pt_title', 'url', 'teacher_id', 'copyright_id'], 'required'],
            [['primary_language_id', 'secondary_language_id', 'teacher_id', 'copyright_id'], 'integer'],
            [['en_title', 'pt_title'], 'string', 'max' => 155],
            [['url'], 'string', 'max' => 255],
            [['length'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'primary_language_id' => 'Primary Language ID',
            'secondary_language_id' => 'Secondary Language ID',
            'en_title' => 'En Title',
            'pt_title' => 'Pt Title',
            'url' => 'Url',
            'teacher_id' => 'Teacher ID',
            'copyright_id' => 'Copyright ID',
            'length' => 'Length',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCopyright()
    {
        return $this->hasOne(Copyright::className(), ['id' => 'copyright_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'primary_language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecondaryLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'secondary_language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }
}
