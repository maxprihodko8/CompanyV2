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
