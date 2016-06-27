<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $id_ot
 * @property string $id_nt
 *
 * @property Resource[] $resources
 * @property Resource[] $resources0
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'id_ot', 'id_nt'], 'required'],
            [['name', 'code', 'id_ot', 'id_nt'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'En Name',
            'code' => 'Pt Name',
            'id_ot' => 'Id Ot',
            'id_nt' => 'Id Nt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources()
    {
        return $this->hasMany(Resource::className(), ['secondary_language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources0()
    {
        return $this->hasMany(Resource::className(), ['primary_language_id' => 'id']);
    }
}
