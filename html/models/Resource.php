<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource".
 *
 * @property integer $id
 * @property integer $resource_type_id
 * @property integer $resource_source_id
 * @property integer $organization_id
 * @property integer $hit_counter
 * @property integer $teacher_id
 * @property integer $primary_language_id
 * @property integer $secondary_language_id
 * @property string $en_name
 * @property string $pt_name
 * @property string $en_description
 * @property string $pt_description
 * @property string $resource_url
 *
 * @property Language $secondaryLanguage
 * @property Organization $organization
 * @property Language $primaryLanguage
 */
class Resource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['resource_type_id', 'resource_source_id', 'organization_id', 'primary_language_id', 'en_name', 'pt_name', 'resource_url'], 'required'],
            [['resource_type_id', 'resource_source_id', 'organization_id', 'hit_counter', 'teacher_id', 'primary_language_id', 'secondary_language_id'], 'integer'],
            [['en_description', 'pt_description'], 'string'],
            [['en_name', 'pt_name'], 'string', 'max' => 45],
            [['resource_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resource_type_id' => 'Resource Type ID',
            'resource_source_id' => 'Resource Source ID',
            'organization_id' => 'Organization ID',
            'hit_counter' => 'Hit Counter',
            'teacher_id' => 'Teacher ID',
            'primary_language_id' => 'Primary Language ID',
            'secondary_language_id' => 'Secondary Language ID',
            'en_name' => 'En Name',
            'pt_name' => 'Pt Name',
            'en_description' => 'En Description',
            'pt_description' => 'Pt Description',
            'resource_url' => 'Resource Url',
        ];
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
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'primary_language_id']);
    }
}
