<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "bid".
 *
 * @property integer $id
 * @property string $description
 * @property double $price
 * @property string $begin_time
 * @property integer $company_id
 * @property integer $tender_id
 * @property string $end_time
 *
 * @property Company $company
 * @property Tender $tender
 * @property Tender[] $tenders
 */
class Bid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['begin_time', 'end_time'], 'safe'],
            ['end_time', 'checkBeginTimeMoreThanEndTime'],
            [['company_id', 'tender_id'], 'integer'],
            [['description'], 'string', 'max' => 2000],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['tender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tender::className(), 'targetAttribute' => ['tender_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'price' => 'Price',
            'begin_time' => 'Begin Time',
            'company_id' => 'Company ID',
            'tender_id' => 'Tender ID',
            'end_time' => 'End Time',
        ];
    }

    public function getResultTime() {
        $time_start = new \DateTime($this->begin_time);
        $end_time = new \DateTime($this->end_time);
        return $end_time->getTimestamp() - $time_start->getTimestamp();
    }

    public function getTenderName() {
        return $this->tender ? $this->tender->name : "";
    }

    public function getCompanyName() {
        return $this->company ? $this->company->name : "";
    }

    public function checkBeginTimeMoreThanEndTime() {
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
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTender()
    {
        return $this->hasOne(Tender::className(), ['id' => 'tender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenders()
    {
        return $this->hasMany(Tender::className(), ['winner_bid_id' => 'id']);
    }
}
