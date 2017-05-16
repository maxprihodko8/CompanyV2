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
 * @property string $time_end
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
            [['begin_time', 'time_end'], 'safe'],
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
            'time_end' => 'Time End',
        ];
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
        return $this->hasMany(Tender::className(), ['bid_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\db\query\BidQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\db\query\BidQuery(get_called_class());
    }
}
