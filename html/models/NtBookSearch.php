<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NtBook;

/**
 * NtBookSearch represents the model behind the search form about `app\models\NtBook`.
 */
class NtBookSearch extends NtBook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'num_chapters'], 'integer'],
            [['book_en', 'book_pt', 'book_code'], 'safe'],
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
        $query = NtBook::find();

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
            'num_chapters' => $this->num_chapters,
        ]);

        $query->andFilterWhere(['like', 'book_en', $this->book_en])
            ->andFilterWhere(['like', 'book_pt', $this->book_pt])
            ->andFilterWhere(['like', 'book_code', $this->book_code]);

        return $dataProvider;
    }
}
