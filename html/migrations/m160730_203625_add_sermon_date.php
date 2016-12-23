<?php

use yii\db\Migration;

class m160730_203625_add_sermon_date extends Migration
{
    public function up()
    {
//        $this->dropColumn( 'teaching', 'sermon_date' );
        $this->addColumn( 'teaching', 'sermon_date', 'datetime NULL default NOW()' );

    }

    public function down()
    {
        echo "m160730_203625_add_sermon_date cannot be reverted.\n";

        return false;
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
