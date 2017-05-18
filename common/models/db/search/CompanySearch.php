<?php

namespace common\models\db\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\Company;

/**
 * CompanySearch represents the model behind the search form about `common\models\db\Company`.
 */
class CompanySearch extends Company
{
    public $search_field_main;
    public $search_field_additional;
    public $search_field_date;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'adress', 'phone', 'contact_user', 'register_date', 'search_field_main', 'search_field_additional', 'search_field_date'], 'safe'],
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
        $query = Company::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'register_date' => $this->register_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'contact_user', $this->contact_user]);

        $query->orFilterWhere(['LIKE', 'company.id', $this->search_field_main])
            ->orFilterWhere(['LIKE', 'company.name', $this->search_field_main])
            ->orFilterWhere(['LIKE', 'company.adress', $this->search_field_main])
            ->orFilterWhere(['LIKE', 'company.phone', $this->search_field_additional])
            ->orFilterWhere(['LIKE', 'company.contact_user', $this->search_field_additional])
            ->orFilterWhere(['LIKE', 'company.register_date', $this->search_field_date]);

        return $dataProvider;
    }
}
