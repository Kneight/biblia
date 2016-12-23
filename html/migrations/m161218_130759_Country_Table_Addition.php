<?php

use yii\db\Migration;

class m161218_130759_Country_Table_Addition extends Migration
{
    public function up()
    {

        /**
         * country Table:
        int id (primary key)
        varchar(55) native_name (should be big enough)
        varchar(55) common_name
        varchar(3) code

         */

        $this->createTable( 'country', array(
            'id'            => 'pk',
            'native_name'   => 'varchar(55) NOT NULL',
            'common_name'   => 'varchar(55) NOT NULL',
            'code'          => 'varchar(3) NOT NULL',
        ) );


        /**
        country_app_language Table:
        int id (primary key)
        int country_id (foreign key to country table)
        int app_language_id (foreign key to app_language table)
         */

        $this->createTable( 'country_app_language', array(
            'id'                => 'pk',
            'country_id'        => 'int NOT NULL',
            'app_language_id'   => 'int NOT NULL',
        ) );

        /**
        country_resource_language Table:
        int id (primary key)
        int country_id (foreign key to country table)
        int app_language_id (foreign key to app_language table)

        When people select a country, we will make a call to country_app_language and country_resource_language getting
         * all with that country ID, joining in the languages table to get them actual language names instead of the ids
         * of course.
         */

        $this->createTable( 'country_resource_language', array(
            'id'                => 'pk',
            'country_id'        => 'int NOT NULL',
            'app_language_id'   => 'int NOT NULL',
        ) );

        //Add Foreign Keys tying the multi-setup runner
        // 4 needed
        $this->addForeignKey( 'country_app_language_country_id_country_id',             'country_app_language',         'country_id',       'country',  'id' );
        $this->addForeignKey( 'country_app_language_app_language_id_language_id',       'country_app_language',         'app_language_id',  'language', 'id' );
        $this->addForeignKey( 'country_resource_language_country_id_country_id',        'country_resource_language',    'country_id',       'country',  'id' );
        $this->addForeignKey( 'country_resource_language_app_language_id_language_id',  'country_resource_language',    'app_language_id',  'language', 'id' );

    }

    public function down()
    {
        echo "m161218_130759_Country_Table_Addition cannot be reverted.\n";

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
