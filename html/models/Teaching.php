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
 * @property string $length
 * @property integer $organization_id
 * @property integer $hit_counter
 *
 * @property Organization $organization
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
            [['primary_language_id', 'en_title', 'pt_title', 'url', 'teacher_id', 'organization_id'], 'required'],
            [['primary_language_id', 'secondary_language_id', 'teacher_id', 'organization_id', 'hit_counter'], 'integer'],
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
            'length' => 'Length',
            'organization_id' => 'Organization ID',
            'hit_counter' => 'Hit Counter',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }
}
