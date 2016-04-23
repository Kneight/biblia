<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Resource[] $resources
 * @property ResourceSource[] $resourceSources
 */
class ResourceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resource_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources()
    {
        return $this->hasMany(Resource::className(), ['resource_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceSources()
    {
        return $this->hasMany(ResourceSource::className(), ['resource_type_id' => 'id']);
    }
}
