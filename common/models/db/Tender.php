<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tender".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property string $begin_time
 * @property string $end_time
 * @property integer $company_id
 * @property integer $winner_bid_id
 *
 * @property Bid[] $bs
 * @property Bid $winnerBid
 * @property Company $company
 */
class Tender extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tender';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['begin_time', 'end_time'], 'safe'],
            ['end_time', 'checkIfBeginTimeSmaller'],
            [['company_id', 'winner_bid_id'], 'integer'],
            [['name'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 2000],
            [['winner_bid_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bid::className(), 'targetAttribute' => ['winner_bid_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'begin_time' => 'Begin Time',
            'end_time' => 'End Time',
            'company_id' => 'Company ID',
            'winner_bid_id' => 'Winner Bid ID',
        ];
    }

    public function checkIfBeginTimeSmaller() {
        $begin_time = new \DateTime($this->begin_time);
        $end_time = new \DateTime($this->end_time);
        if($begin_time > $end_time) {
            $this->addError($this->end_time, 'End time more than begin!');
            Yii::$app->session->setFlash('error', 'End time more than begin time');
        }
        return true;
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBs()
    {
        return $this->hasMany(Bid::className(), ['tender_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWinnerBid()
    {
        return $this->hasOne(Bid::className(), ['id' => 'winner_bid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
