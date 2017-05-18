<?php

use yii\db\Migration;
use yii\db\Schema;

class m170518_132104_tender extends Migration
{
    public function up()
    {
        $this->createTable('tender', [
            'id' => $this->primaryKey(),
            'name' => $this->string(500),
            'price' => $this->double(),
            'description' => $this->string(2000),
            'begin_time' => $this->dateTime(),
            'end_time' => $this->dateTime(),
            'company_id' => $this->integer(),
            'winner_bid_id' => $this->integer()
        ]);

        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name' => $this->string(1000),
            'adress' => $this->string(500),
            'phone' => $this->string(500),
            'contact_user' => $this->string(500),
            'register_date' => $this->dateTime(),
        ]);

        $this->createTable('bid', [
            'id' => $this->primaryKey(),
            'price' => $this->double(),
            'description' => $this->string(2000),
            'begin_time' => $this->dateTime(),
            'end_time' => $this->dateTime(),
            'company_id' => $this->integer(),
            'tender_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-tender-winner_id',
            'tender',
            'winner_bid_id',
            'bid',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-tender-company_id',
            'tender',
            'company_id',
            'company',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-bid-company_id',
            'bid',
            'company_id',
            'company',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-bid-tender_id',
            'bid',
            'tender_id',
            'tender',
            'id',
            'CASCADE',
            'CASCADE'
        );

        if(\common\models\service\UserService::getUserByUserName('admin') === null) {
            $this->insert('user', [
                'id' => 1,
                'username' => 'admin',
                'password_hash' => '$2a$04$pDhBD41yVVZJN4bxdYt3ceDinoPKNhvtQeycQjIBVUercYhf9JOoS', //// 'admin'
                'status' => '10',
                'auth_key' => 'auth-admin_new231321332',
                'email' => 'admin@admin.com',
                'created_at' => time(),
                'updated_at' => time(),
            ]);
        }

        $this->batchInsert('company', ['id', 'name', 'adress', 'contact_user', 'phone', 'register_date'], [
            [1, 'Company1', 'Sumy', 'SomeUser1', '+382344224', '2017-05-16 17:16:59'],
            [2, 'Company2', 'Kiev', 'SomeUser2', '+324244322', '2017-05-17 12:13:59'],
            [3, 'Company3', 'Lviv', 'SomeUser3', '+213133213', '2017-05-18 17:11:59'],
            [4, 'Company4', 'Lviv', 'SomeUser5', '+342233423', '2017-05-19 17:11:59'],
        ]);

        $this->batchInsert('tender', ['id', 'name', 'description', 'price', 'begin_time', 'end_time', 'company_id'], [
            [1, 'Tender1', 'Tender 1 for some companies', '100', '2017-05-16 17:16:59', '2017-05-20 18:16:59', '1'],
            [2, 'Tender2', 'Tender 2 for some companies', '50', '2017-05-22 17:16:59', '2017-05-27 18:16:59', '2'],
        ]);

        $this->batchInsert('bid', ['id', 'description', 'price', 'begin_time', 'end_time', 'company_id', 'tender_id'], [
            [1, 'Bid 1 for some tenders - company 3', '120', '2017-05-16 17:16:59', '2017-05-22 18:16:59', '3', '1'],
            [2, 'Bid 2 for some tenders - company 4', '70', '2017-05-19 17:16:59', '2017-05-24 18:16:59', '4', '1'],
            [3, 'Bid 3 for some tenders - company 3', '80', '2017-05-18 17:16:59', '2017-05-23 18:16:59', '3', '2'],
            [4, 'Bid 4 for some tenders - company 4', '90', '2017-05-19 19:16:59', '2017-05-22 22:16:59', '4', '2'],
        ]);
    }

    public function down()
    {
        $this->dropForeignKey('fk-tender-winner_id', 'tender');
        $this->dropForeignKey('fk-tender-company_id', 'tender');
        $this->dropForeignKey('fk-bid-company_id', 'bid');
        $this->dropForeignKey('fk-bid-tender_id', 'bid');
        $this->dropTable('bid');
        $this->dropTable('tender');
        $this->dropTable('company');
        return true;
    }
}
