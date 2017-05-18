<?php

/**
 * Created by PhpStorm.
 * User: fancy
 * Date: 17.05.17
 * Time: 20:55
 */
namespace common\models\service;

use common\models\db\Company;
use yii\helpers\ArrayHelper;

class CompanyService
{
    public static function getCompanies() {
        return \common\models\db\Company::find()
            ->all();
    }

    public static function getCompaniesCount() {
        return Company::find()->count();
    }

    public static function getCompaniesAssocArray() {
        return ArrayHelper::map(self::getCompanies(), 'id','name');
    }

}