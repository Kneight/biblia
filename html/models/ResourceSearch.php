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
    public $resourceTypeName;
    public $organizationName;
    public $teacherName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'resource_type_id', 'organization_id', 'hit_counter', 'teacher_id', 'primary_language_id', 'secondary_language_id'], 'integer'],
            [['en_name', 'pt_name', 'en_description', 'pt_description', 'resource_url', 'resourceTypeName', 'organizationName', 'teacherName'], 'safe'],
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

        $dataProvider->setSort( [
            'attributes' => [
                'id',
                'en_name',
                'hit_counter',
                'resourceTypeName' => [
                    'asc' => ['resource_type.name' => SORT_ASC],
                    'desc' => ['resource_type.name' => SORT_DESC],
                    'label' => 'Type',
                ],
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
            $query->joinWith(['resourceType']);
            $query->joinWith(['teacher']);
            $query->joinWith(['organization']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'resource.id' => $this->id,
            'resource.resource_type_id' => $this->resource_type_id,
            'resource.organization_id' => $this->organization_id,
            'resource.hit_counter' => $this->hit_counter,
            'resource.teacher_id' => $this->teacher_id,
            'resource.primary_language_id' => $this->primary_language_id,
            'resource.secondary_language_id' => $this->secondary_language_id,
        ]);

        $query->andFilterWhere(['like', 'en_name', $this->en_name])
            ->andFilterWhere(['like', 'pt_name', $this->pt_name])
            ->andFilterWhere(['like', 'en_description', $this->en_description])
            ->andFilterWhere(['like', 'pt_description', $this->pt_description])
            ->andFilterWhere(['like', 'resource_url', $this->resource_url]);

        // filter by resource Type Name
        $query->joinWith(['resourceType' => function ($q) {
            $q->where('resource_type.name LIKE "%' . $this->resourceTypeName . '%"');
        }]);

        // filter by resource Type Name
        $query->joinWith(['teacher' => function ($q) {
            $q->where('teacher.en_name LIKE "%' . $this->teacherName . '%"');
        }]);

        // filter by resource Type Name
        $query->joinWith(['organization' => function ($q) {
            $q->where('organization.en_name LIKE "%' . $this->organizationName . '%"');
        }]);

        return $dataProvider;
    }
}
