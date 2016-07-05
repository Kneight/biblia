<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;

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
    public $file_upload;

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
            [['en_name', 'en_description', 'pt_name', 'pt_description', 'license_type_id'], 'required'],
            [['year'], 'integer'],
            [['en_name', 'pt_name', 'photo'], 'string', 'max' => 155],
            [['en_description', 'pt_description'], 'string'],
            [['license_type_id', 'title', 'group'], 'string', 'max' => 255],
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
            'photo' => 'Photo',
            'license_type_id' => 'License Type',
            'title' => 'Title',
            'year' => 'Year',
            'group' => 'Group',
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

        if( !is_dir( 'uploads/photo/organization' ) )
            mkdir( 'uploads/photo/organization', 0775, true );
        $FileName = 'uploads/photo/organization/' . $this->id . '.' . $this->file_upload->extension;
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
