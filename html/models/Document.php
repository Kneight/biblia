<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property integer $id
 * @property integer $primary_language_id
 * @property integer $secondary_language_id
 * @property string $en_title
 * @property string $en_description
 * @property string $pt_title
 * @property string $pt_description
 * @property string $author
 * @property integer $copyright_id
 * @property string $document_type
 *
 * @property Copyright $copyright
 * @property Language $primaryLanguage
 * @property Language $secondaryLanguage
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['primary_language_id', 'en_title', 'en_description', 'pt_title', 'pt_description', 'author', 'copyright_id', 'document_type'], 'required'],
            [['primary_language_id', 'secondary_language_id', 'copyright_id'], 'integer'],
            [['en_title', 'pt_title', 'author'], 'string', 'max' => 155],
            [['en_description', 'pt_description'], 'string', 'max' => 255],
            [['document_type'], 'string', 'max' => 45]
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
            'en_description' => 'En Description',
            'pt_title' => 'Pt Title',
            'pt_description' => 'Pt Description',
            'author' => 'Author',
            'copyright_id' => 'Copyright ID',
            'document_type' => 'Document Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCopyright()
    {
        return $this->hasOne(Copyright::className(), ['id' => 'copyright_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'primary_language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecondaryLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'secondary_language_id']);
    }
}
