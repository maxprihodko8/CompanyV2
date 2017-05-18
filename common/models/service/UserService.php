<?php
/**
 * Created by PhpStorm.
 * User: fancy
 * Date: 18.05.17
 * Time: 13:25
 */

namespace common\models\service;


use common\models\User;

class UserService
{
    public static function getUserByUserName($username) {
        return User::findOne(['username' => $username]);
    }

    public static function getUserByEmail($email) {
        return User::findOne(['email' => $email]);
    }

    public static function checkIfUserExists(User $user) {
        if(self::getUserByEmail($user->email) || self::getUserByUserName($user->username)) {
            return false;
        } else {
            return true;
        }
    }
}