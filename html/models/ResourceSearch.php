<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Resource;

/**
 * ResourceSearch represents the model behind the search form about `app\models\Resource`.
 */
class ResourceSearch extends Resource
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'resource_type_id', 'resource_source_id', 'organization_id', 'hit_counter', 'teacher_id', 'primary_language_id', 'secondary_language_id'], 'integer'],
            [['en_name', 'pt_name', 'en_description', 'pt_description', 'resource_url'], 'safe'],
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
        $query = Resource::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'resource_type_id' => $this->resource_type_id,
            'resource_source_id' => $this->resource_source_id,
            'organization_id' => $this->organization_id,
            'hit_counter' => $this->hit_counter,
            'teacher_id' => $this->teacher_id,
            'primary_language_id' => $this->primary_language_id,
            'secondary_language_id' => $this->secondary_language_id,
        ]);

        $query->andFilterWhere(['like', 'en_name', $this->en_name])
            ->andFilterWhere(['like', 'pt_name', $this->pt_name])
            ->andFilterWhere(['like', 'en_description', $this->en_description])
            ->andFilterWhere(['like', 'pt_description', $this->pt_description])
            ->andFilterWhere(['like', 'resource_url', $this->resource_url]);

        return $dataProvider;
    }
}
