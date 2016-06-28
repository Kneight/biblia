<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property integer $id
 * @property string $en_name
 * @property string $en_description
 * @property string $pt_name
 * @property string $pt_description
 * @property string $location
 * @property string $photo
 * @property integer $organization_id
 *
 * @property Organization $organization
 * @property Teaching[] $teachings
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['en_name', 'en_description', 'pt_name', 'pt_description', 'location', 'photo', 'organization_id'], 'required'],
            [['organization_id'], 'integer'],
            [['en_name', 'pt_name', 'location'], 'string', 'max' => 100],
            [['en_description', 'pt_description'], 'string'],
            [['photo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'en_name' => 'En Name',
            'en_description' => 'En Description',
            'pt_name' => 'Pt Name',
            'pt_description' => 'Pt Description',
            'location' => 'Location',
            'photo' => 'Photo',
            'organization_id' => 'Organization ID',
            'organizationName' => 'Organization',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    public function getOrganizationName()
    {
        return $this->organization->en_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachings()
    {
        return $this->hasMany(Teaching::className(), ['teacher_id' => 'id']);
    }
}
