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

    public $organizationName;
    public $teacherName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'primary_language_id', 'secondary_language_id', 'teacher_id', 'organization_id', 'hit_counter'], 'integer'],
            [['en_title', 'pt_title', 'url', 'length', 'organizationName', 'teacherName'], 'safe'],
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
        $query->orderBy( 'created_at DESC' );

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort( [
            'attributes' => [
                'id',
                'en_title',
                'hit_counter',
                'length',
                'created_at',
                'organizationName' => [
                    'asc' => ['organization.en_name' => SORT_ASC],
                    'desc' => ['organization.en_name' => SORT_DESC],
                    'label' => 'Organization',
                ],
                'teacherName' => [
                    'asc' => ['teacher.en_name' => SORT_ASC],
                    'desc' => ['teacher.en_name' => SORT_DESC],
                    'label' => 'Teacher',
                ],
            ],
        ] );

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
            'organization_id' => $this->organization_id,
            'hit_counter' => $this->hit_counter,
        ]);

        $query->andFilterWhere(['like', 'en_title', $this->en_title])
            ->andFilterWhere(['like', 'pt_title', $this->pt_title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'en_description', $this->en_description])
            ->andFilterWhere(['like', 'pt_description', $this->pt_description])
            ->andFilterWhere(['like', 'length', $this->length]);

        // filter by TeacherName
        $query->joinWith(['teacher' => function ($q) {
            $q->where('teacher.en_name LIKE "%' . $this->teacherName . '%"');
        }]);

        // filter by organizationName
        $query->joinWith(['organization' => function ($q) {
            $q->where('organization.en_name LIKE "%' . $this->organizationName . '%"');
        }]);


        return $dataProvider;
    }
}
