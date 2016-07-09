<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

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
    public $file_upload;

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
            [['file_upload'], 'image', 'skipOnEmpty' => true, 'minWidth' => 150, 'minHeight' => 150],
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
     * Upload the file
     * @return bool
     */
    public function upload()
    {
        if( !$this->file_upload )
        {
            return !is_null( $this->photo );
        }

        $saniName = preg_replace("/\.(jpg|png|jpeg)/", "", $this->file_upload->name);
        $saniName = preg_replace("/[^A-Za-z0-9]/", "", $saniName);

        if( !is_dir( 'uploads/photo/teacher' ) )
            mkdir( 'uploads/photo/teacher', 0775, true );
        $FileName = 'uploads/photo/teacher/' . $saniName . '.' . $this->file_upload->extension;
        if( $this->file_upload )
            $this->photo = BaseUrl::toRoute( $FileName, true );
        if ( $this->save() ) {
            if( $this->file_upload ){
                $this->file_upload->saveAs( $FileName );
                Yii::$app->image->load($FileName)->resize( 150, 150, 0x07 )->background( 'FFF', 0 )->save();
            }
            return true;
        } else {
            return false;
        }
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
