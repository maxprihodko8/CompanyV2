<?php

/**
 * Created by PhpStorm.
 * User: fancy
 * Date: 17.05.17
 * Time: 20:53
 */
namespace common\models\service;

use common\models\db\Bid;
use yii\helpers\ArrayHelper;

class BidService
{
    public static function getBids() {
        return \common\models\db\Bid::find()
            ->all();
    }

    public static function getBidsCount() {
        return count(self::getBids());
    }

    public static function getBidsListAssocArray() {
        return ArrayHelper::map(self::getBids(), 'id', 'description');
    }

    public static function getSortedBidsForTender($tender_id) {
        $bids = Bid::find()
            ->joinWith('tender')
            ->all();
        return $bids;
    }

}