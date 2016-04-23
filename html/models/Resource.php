<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource".
 *
 * @property integer $id
 * @property integer $resource_type_id
 * @property integer $resource_source_id
 * @property string $resource_col
 *
 * @property ResourceSource $resourceSource
 * @property ResourceType $resourceType
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
            [['resource_type_id', 'resource_source_id', 'resource_col'], 'required'],
            [['resource_type_id', 'resource_source_id'], 'integer'],
            [['resource_col'], 'string', 'max' => 45]
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
            'resource_col' => 'Resource Col',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceSource()
    {
        return $this->hasOne(ResourceSource::className(), ['id' => 'resource_source_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceType()
    {
        return $this->hasOne(ResourceType::className(), ['id' => 'resource_type_id']);
    }
}
