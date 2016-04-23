<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "copyright".
 *
 * @property integer $id
 * @property string $title
 * @property string $year
 * @property string $group
 * @property string $license
 *
 * @property Document[] $documents
 * @property Teaching[] $teachings
 */
class Copyright extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'copyright';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'year', 'group', 'license'], 'required'],
            [['title', 'year', 'group', 'license'], 'string', 'max' => 155]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'year' => 'Year',
            'group' => 'Group',
            'license' => 'License',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['copyright_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachings()
    {
        return $this->hasMany(Teaching::className(), ['copyright_id' => 'id']);
    }
}
