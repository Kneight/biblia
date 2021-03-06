<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Organization;

/**
 * OrganizationSearch represents the model behind the search form about `app\models\Organization`.
 */
class OrganizationSearch extends Organization
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['en_name', 'en_description', 'pt_name', 'pt_description', 'photo', 'license_type_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Organization::find();

        $query->addOrderBy( 'id asc' );

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if( !Yii::$app->user->isGuest && !Yii::$app->user->can('admin') )
            $query->andWhere( [ 'id' => Yii::$app->user->getIdentity()->banned_reason ] );


        $query->andFilterWhere([
            'id' => $this->id,
            'license_type_id', $this->license_type_id,
        ]);

        $query->andFilterWhere(['like', 'en_name', $this->en_name])
            ->andFilterWhere(['like', 'en_description', $this->en_description])
            ->andFilterWhere(['like', 'pt_name', $this->pt_name])
            ->andFilterWhere(['like', 'pt_description', $this->pt_description])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }
}
