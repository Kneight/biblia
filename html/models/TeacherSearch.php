<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Teacher;

/**
 * TeacherSearch represents the model behind the search form about `app\models\Teacher`.
 */
class TeacherSearch extends Teacher
{
    public $organizationName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'organization_id'], 'integer'],
            [['en_name', 'en_description', 'pt_name', 'pt_description', 'location', 'photo', 'organizationName'], 'safe'],
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
        $query = Teacher::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->orderBy( 'id asc' );

        $dataProvider->setSort( [
            'attributes' => [
                'id',
                'en_name',
                'en_description',
                'organizationName' => [
                    'asc' => ['organization.en_name' => SORT_ASC],
                    'desc' => ['organization.en_name' => SORT_DESC],
                    'label' => 'Organization',
                ],
            ],
        ] );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith( ['organization'] );
            return $dataProvider;
        }

        if( !Yii::$app->user->can('admin') )
        {
            $query->andWhere( [ 'organization_id' => Yii::$app->user->getIdentity()->banned_reason ] );
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'organization_id' => $this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'en_name', $this->en_name])
            ->andFilterWhere(['like', 'en_description', $this->en_description])
            ->andFilterWhere(['like', 'pt_name', $this->pt_name])
            ->andFilterWhere(['like', 'pt_description', $this->pt_description])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        // filter by organization Name
        $query->joinWith(['organization' => function ($q) {
            $q->where('organization.en_name LIKE "%' . $this->organizationName . '%"');
        }]);

        return $dataProvider;
    }
}
