<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $adress
 * @property string $phone
 * @property string $contact_user
 * @property string $register_date
 *
 * @property Bid[] $bs
 * @property Tender[] $tenders
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['register_date'], 'safe'],
            [['name'], 'string', 'max' => 1000],
            [['adress', 'phone', 'contact_user'], 'string', 'max' => 500],
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
            'adress' => 'Adress',
            'phone' => 'Phone',
            'contact_user' => 'Contact User',
            'register_date' => 'Register Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBs()
    {
        return $this->hasMany(Bid::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenders()
    {
        return $this->hasMany(Tender::className(), ['company_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\db\query\CompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\db\query\CompanyQuery(get_called_class());
    }
}
