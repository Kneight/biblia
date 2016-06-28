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
 * * @property string $en_description
 * * @property string $pt_description
 * @property string $url
 * @property integer $teacher_id
 * @property string $length
 * @property integer $organization_id
 * @property integer $hit_counter
 *
 * @property Organization $organization
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
            [['primary_language_id', 'en_title', 'pt_title', 'url', 'teacher_id', 'organization_id'], 'required'],
            [['primary_language_id', 'secondary_language_id', 'teacher_id', 'organization_id', 'hit_counter'], 'integer'],
            [['en_title', 'pt_title'], 'string', 'max' => 155],
            [['url'], 'string', 'max' => 255],
            [['en_description', 'pt_description'], 'string'],
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
            'organizationName' => 'Organization',
            'teacherName' => 'Teacher',
            'en_description' => 'En Description',
            'pt_description' => 'Pt Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }

    public function getTeacherName()
    {
        return $this->teacher->en_name;
    }

    public function getOrganizationName()
    {
        return $this->organization->en_name;
    }
}
