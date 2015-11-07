<?php

use yii\db\Schema;
use yii\db\Migration;

class m151107_121138_content extends Migration
{
    public function up()
    {
        $this->createTable('content', [
            'id' => Schema::TYPE_PK,
            'content' => Schema::TYPE_TEXT,
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }
    

    public function down()
    {
        $this->dropTable('content');
    }
}
