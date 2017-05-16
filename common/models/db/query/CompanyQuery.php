<?php

namespace common\models\db\query;

/**
 * This is the ActiveQuery class for [[\common\models\db\Company]].
 *
 * @see \common\models\db\Company
 */
class CompanyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\db\Company[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\db\Company|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
