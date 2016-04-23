<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource_source".
 *
 * @property integer $id
 * @property integer $resource_type_id
 * @property string $path
 *
 * @property Resource[] $resources
 * @property ResourceType $resourceType
 */
class ResourceSource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resource_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['resource_type_id', 'path'], 'required'],
            [['resource_type_id'], 'integer'],
            [['path'], 'string', 'max' => 255]
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
            'path' => 'Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources()
    {
        return $this->hasMany(Resource::className(), ['resource_source_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceType()
    {
        return $this->hasOne(ResourceType::className(), ['id' => 'resource_type_id']);
    }
}
