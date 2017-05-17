<?php

/**
 * Created by PhpStorm.
 * User: fancy
 * Date: 17.05.17
 * Time: 21:38
 */
namespace common\models\helpers;

use Exception;

class ArrayHelper
{
    public static function setValueAtBeginning($value, $array) {
        try {
            if (isset($value) && isset($array)) {
                foreach ($array as $key => $arr_val) {
                    if ($value === $arr_val) {
                        unset($array[$key]);
                        array_unshift($array, $value);
                    }
                }
            }
        } catch (Exception $exception) {}
        return $array;
    }
}