<?php

use yii\db\Schema;
use yii\db\Migration;

class m151107_130414_cpu extends Migration
{
    public function up()
    {
        $this->createTable('cpu', [
            'id' => Schema::TYPE_PK,
            'page_id' => Schema::TYPE_INTEGER,
            'alias' => Schema::TYPE_TEXT,
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }
    

    public function down()
    {
        $this->dropTable('cpu');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
