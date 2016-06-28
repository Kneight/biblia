<?php

use yii\db\Migration;

class m160627_225108_add_license_id extends Migration
{
    public function up()
    {

        // add license_type table
        $this->createTable( 'license_type', [
            'id' => 'pk',
            'name' => 'varchar(45) NOT NULL',
        ] );

        // link license_type to organization.license_id
        $this->renameColumn( 'organization', 'license', 'license_type_id' );
        $this->alterColumn( 'organization', 'license_type_id', 'int(11) NOT NULL' );
        $this->addForeignKey( 'organization_license_type_id_license_type_id', 'organization', 'license_type_id', 'license_type', 'id' );

        // add created_at to resource
        $this->addColumn( 'resource', 'created_at', 'datetime DEFAULT NOW()' );

        // add created_at to teaching
        $this->addColumn( 'teaching', 'created_at', 'datetime DEFAULT NOW()' );
    }

    public function down()
    {
        echo "m160627_225108_add_license_id cannot be reverted.\n";

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
