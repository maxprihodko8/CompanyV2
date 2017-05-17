<?php

namespace common\models\db\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\Tender;

/**
 * TenderSearch represents the model behind the search form about `common\models\db\Tender`.
 */
class TenderSearch extends Tender
{
    public $search_field;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'winner_bid_id'], 'integer'],
            [['name', 'description', 'begin_time', 'end_time', 'search_field'], 'safe'],
            [['price'], 'number'],
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
        $query = Tender::find();

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
            'price' => $this->price,
            'begin_time' => $this->begin_time,
            'end_time' => $this->end_time,
            'company_id' => $this->company_id,
            'winner_bid_id' => $this->winner_bid_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        $query->orFilterWhere(['LIKE', 'tender.id', $this->search_field])
            ->orFilterWhere(['LIKE', 'tender.name', $this->search_field])
            ->orFilterWhere(['LIKE', 'tender.description', $this->search_field])
            ->orFilterWhere(['LIKE', 'tender.price', $this->search_field])
            ->orFilterWhere(['LIKE', 'tender.begin_time', $this->search_field])
            ->orFilterWhere(['LIKE', 'tender.end_time', $this->search_field]);

        return $dataProvider;
    }
}
