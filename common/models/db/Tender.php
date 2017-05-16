<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tender".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property double $budget
 * @property string $begin_date
 * @property string $execute_time
 * @property integer $company_id
 * @property integer $bid_id
 *
 * @property Bid[] $bs
 * @property Bid $bid
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
            [['budget'], 'number'],
            [['begin_date', 'execute_time'], 'safe'],
            [['company_id', 'bid_id'], 'integer'],
            [['name'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 2000],
            [['bid_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bid::className(), 'targetAttribute' => ['bid_id' => 'id']],
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
            'budget' => 'Budget',
            'begin_date' => 'Begin Date',
            'execute_time' => 'Execute Time',
            'company_id' => 'Company ID',
            'bid_id' => 'Bid ID',
        ];
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
    public function getBid()
    {
        return $this->hasOne(Bid::className(), ['id' => 'bid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
