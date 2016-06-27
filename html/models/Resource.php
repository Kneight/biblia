<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

/**
 * This is the model class for table "resource".
 *
 * @property integer $id
 * @property integer $resource_type_id
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
 * @property UploadedFile $file_upload
 *
 * @property ResourceType $resourceType
 * @property Language $secondaryLanguage
 * @property Organization $organization
 * @property Language $primaryLanguage
 */
class Resource extends \yii\db\ActiveRecord
{
    public $file_upload;

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
            [['resource_type_id', 'organization_id', 'primary_language_id', 'en_name', 'pt_name'], 'required'],
            [['resource_type_id', 'organization_id', 'hit_counter', 'teacher_id', 'primary_language_id', 'secondary_language_id'], 'integer'],
            [['en_description', 'pt_description'], 'string'],
            [['en_name', 'pt_name'], 'string', 'max' => 45],
            [['resource_url'], 'string', 'max' => 255],
            [['file_upload'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, txt, rtf']
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
            'file_upload' => 'File Upload (For Onsite)',
        ];
    }

    /**
     * Upload the file
     * @return bool
     */
    public function upload()
    {
        if( !is_dir( 'uploads/' . $this->organization_id . '/Resource' ) )
            mkdir( 'uploads/' . $this->organization_id . '/Resource', 0775, true );
        $FileName = 'uploads/' . $this->organization_id . '/Resource/' . urlencode( $this->file_upload->baseName ) . '.' . $this->file_upload->extension;
        if( $this->file_upload )
            $this->resource_url = BaseUrl::toRoute( $FileName, true );
        if ( $this->save() ) {
            if( $this->file_upload )
                $this->file_upload->saveAs( $FileName );
            return true;
        } else {
            return false;
        }
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceType()
    {
        return $this->hasOne(ResourceType::className(), ['id' => 'resource_type_id']);
    }
}
