<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property integer $id
 * @property string $en_name
 * @property string $en_description
 * @property string $pt_name
 * @property string $pt_description
 * @property string $photo
 * @property string $license_type_id
 * @property string $title
 * @property integer $year
 * @property string $group
 *
 * @property Resource[] $resources
 * @property Teaching[] $teachings
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['en_name', 'en_description', 'pt_name', 'pt_description', 'photo', 'license_type_id'], 'required'],
            [['year'], 'integer'],
            [['en_name', 'pt_name', 'photo'], 'string', 'max' => 155],
            [['en_description', 'pt_description'], 'string'],
            [['license_type_id', 'title', 'group'], 'string', 'max' => 255],
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
            'photo' => 'Photo',
            'license_type_id' => 'License Type',
            'title' => 'Title',
            'year' => 'Year',
            'group' => 'Group',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources()
    {
        return $this->hasMany(Resource::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachings()
    {
        return $this->hasMany(Teaching::className(), ['organization_id' => 'id']);
    }
}
