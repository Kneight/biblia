<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Teaching;

/**
 * TeachingSearch represents the model behind the search form about `app\models\Teaching`.
 */
class TeachingSearch extends Teaching
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'primary_language_id', 'secondary_language_id', 'teacher_id', 'copyright_id'], 'integer'],
            [['en_title', 'pt_title', 'url', 'length'], 'safe'],
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
        $query = Teaching::find();

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
            'primary_language_id' => $this->primary_language_id,
            'secondary_language_id' => $this->secondary_language_id,
            'teacher_id' => $this->teacher_id,
            'copyright_id' => $this->copyright_id,
        ]);

        $query->andFilterWhere(['like', 'en_title', $this->en_title])
            ->andFilterWhere(['like', 'pt_title', $this->pt_title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'length', $this->length]);

        return $dataProvider;
    }
}
