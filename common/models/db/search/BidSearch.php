<?php

namespace common\models\db\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\Bid;

/**
 * BidSearch represents the model behind the search form about `common\models\db\Bid`.
 */
class BidSearch extends Bid
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
            [['id', 'company_id', 'tender_id'], 'integer'],
            [['description', 'begin_time', 'end_time', 'tenderName', 'companyName', 'resultTime',
                'search_field_main', 'search_field_additional', 'search_field_date'], 'safe'],
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
        $query = Bid::find();
        $query->joinWith(['company', 'tender']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $sort =  $dataProvider->sort;
        $sort->attributes = array_merge($sort->attributes, [
            'companyName' => [
                'asc' => ['company.name' => SORT_ASC],
                'desc' => ['company.name' => SORT_DESC],
                'label' => 'Company Name'
            ],
            'resultTime' => [
                'asc' => ['UNIX_TIMESTAMP(bid.end_time) - UNIX_TIMESTAMP(bid.begin_time)' => SORT_ASC],
                'desc' => ['UNIX_TIMESTAMP(bid.begin_time) - UNIX_TIMESTAMP(bid.end_time)' => SORT_DESC],
                'label' => 'Result time'
            ],
            'tenderName' => [
                'asc' => ['tender.name' => SORT_ASC],
                'desc' => ['tender.name' => SORT_DESC],
                'label' => 'Tender Name'
            ],
        ]);
        $dataProvider->sort = $sort;

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
            'company_id' => $this->company_id,
            'tender_id' => $this->tender_id,
            'end_time' => $this->end_time,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        $query->orFilterWhere(['LIKE', 'bid.id', $this->search_field_main])
        ->orFilterWhere(['LIKE', 'bid.price', $this->search_field_main])
        ->orFilterWhere(['LIKE', 'bid.description', $this->search_field_additional])
        ->orFilterWhere(['LIKE', 'bid.begin_time', $this->search_field_date])
        ->orFilterWhere(['LIKE', 'bid.end_time', $this->search_field_date]);

        return $dataProvider;
    }
}
