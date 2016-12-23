<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $native_name
 * @property string $common_name
 * @property string $code
 *
 * @property CountryAppLanguage[] $countryAppLanguages
 * @property CountryResourceLanguage[] $countryResourceLanguages
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['native_name', 'common_name', 'code'], 'required'],
            [['native_name', 'common_name'], 'string', 'max' => 55],
            [['code'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'native_name' => 'Native Name',
            'common_name' => 'Common Name',
            'code' => 'Code (ISO-3)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryAppLanguages()
    {
        return $this->hasMany(CountryAppLanguage::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryResourceLanguages()
    {
        return $this->hasMany(CountryResourceLanguage::className(), ['country_id' => 'id']);
    }
}
