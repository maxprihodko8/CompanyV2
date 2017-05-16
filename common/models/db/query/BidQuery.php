<?php

namespace common\models\db\query;

/**
 * This is the ActiveQuery class for [[\common\models\db\Bid]].
 *
 * @see \common\models\db\Bid
 */
class BidQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\db\Bid[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\db\Bid|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
