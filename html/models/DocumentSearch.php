<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Document;

/**
 * DocumentSearch represents the model behind the search form about `app\models\Document`.
 */
class DocumentSearch extends Document
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'primary_language_id', 'secondary_language_id', 'copyright_id'], 'integer'],
            [['en_title', 'en_description', 'pt_title', 'pt_description', 'author', 'document_type'], 'safe'],
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
        $query = Document::find();

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
            'copyright_id' => $this->copyright_id,
        ]);

        $query->andFilterWhere(['like', 'en_title', $this->en_title])
            ->andFilterWhere(['like', 'en_description', $this->en_description])
            ->andFilterWhere(['like', 'pt_title', $this->pt_title])
            ->andFilterWhere(['like', 'pt_description', $this->pt_description])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'document_type', $this->document_type]);

        return $dataProvider;
    }
}
