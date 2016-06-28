<?php

use yii\db\Migration;

class m160628_064618_expand_descriptions extends Migration
{
    public function up()
    {
        $this->addColumn( 'teaching', 'en_description', 'text NULL' );
        $this->addColumn( 'teaching', 'pt_description', 'text NULL' );

        $this->alterColumn( 'teacher', 'en_description', 'text NULL' );
        $this->alterColumn( 'teacher', 'pt_description', 'text NULL' );

        $this->alterColumn( 'organization', 'en_description', 'text NULL' );
        $this->alterColumn( 'organization', 'pt_description', 'text NULL' );
    }

    public function down()
    {
        echo "m160628_064618_expand_descriptions cannot be reverted.\n";

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
