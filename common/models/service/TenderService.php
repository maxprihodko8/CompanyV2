<?php

/**
 * Created by PhpStorm.
 * User: fancy
 * Date: 17.05.17
 * Time: 20:56
 */
namespace common\models\service;

use yii\helpers\ArrayHelper;

class TenderService
{
    public static function getTenders() {
        return \common\models\db\Tender::find()
            ->all();
    }

    public static function getTendersCount() {
        return count(self::getTenders());
    }

    public static function getTendersAssocArray() {
        return ArrayHelper::map(self::getTenders(), 'id', 'name');
    }
}