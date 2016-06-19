<?php

use yii\db\Migration;

class m160619_150000_resource_source_remove_from_resource extends Migration
{
    public function up()
    {
        $this->dropColumn( 'resource', 'resource_source_id' );
    }

    public function down()
    {
        echo "m160619_150000_resource_source_remove_from_resource cannot be reverted.\n";

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
