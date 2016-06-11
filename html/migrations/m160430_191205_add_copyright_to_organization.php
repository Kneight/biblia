<?php

use yii\db\Migration;

class m160430_191205_add_copyright_to_organization extends Migration
{
    public function up()
    {
        /**
         * Update Schema for organization table
         */
        $this->addColumn( 'organization', 'license', 'varchar(255) NOT NULL' );
        $this->addColumn( 'organization', 'title', 'varchar(255)' );
        $this->addColumn( 'organization', 'year', 'int(4)' );
        $this->addColumn( 'organization', 'group', 'varchar(255)' );

        /**
         * Drop the old copyright table
         */
        $this->dropForeignKey( 'teaching_copyright_id_copyright_id', 'teaching' );
        $this->dropColumn( 'teaching', 'copyright_id' );
        $this->dropForeignKey( 'document_copyright_id_copyright_id', 'document' );
        $this->dropColumn( 'document', 'copyright_id' );
        $this->dropTable( 'copyright' );

        /**
         * Tie Foreign keys to things that need copyrights/organizations
         */
        //Teaching
        $this->addColumn( 'teaching', 'organization_id', 'int(11) NOT NULL' );
        $this->addForeignKey( 'teaching_organization_id_organization_id', 'teaching', 'organization_id', 'organization', 'id' );
        //Resource
        $this->addColumn( 'resource', 'organization_id', 'int(11) NOT NULL' );
        $this->addForeignKey( 'resource_organization_id_organization_id', 'resource', 'organization_id', 'organization', 'id' );
        //document
        $this->addColumn( 'document', 'organization_id', 'int(11) NOT NULL' );
        $this->addForeignKey( 'document_organization_id_organization_id', 'document', 'organization_id', 'organization', 'id' );

        /**
         * Add to Language
         * nt_organization_id
         * ot_organization_id
         */
        //change dam_(ot|nt) to id_(ot/nt) in language change to TYPE of varchar(10)
        $this->renameColumn( 'language', 'dam_ot', 'id_ot' );
        $this->renameColumn( 'language', 'dam_nt', 'id_nt' );

        //Add hit counter to teaching and resource
        $this->addColumn( 'teaching', 'hit_counter', 'int(11) DEFAULT 0' );
        $this->addColumn( 'resource', 'hit_counter', 'int(11) DEFAULT 0' );

        /**
         * Resource: Remove resource_col,
         * add organization_id, Add teacher_id (Not required), add language( primary/secondary ),
         * add (en_/pt_) Name(45) and descriptions( text ),
         * Remove resource_source table, create ResourceURL
         */

        $this->dropColumn( 'resource', 'resource_col' );
        $this->addColumn( 'resource', 'teacher_id', 'int(11)' );
        $this->addColumn( 'resource', 'primary_language_id', 'int(11) NOT NULL' );
        $this->addColumn( 'resource', 'secondary_language_id', 'int(11)' );
        $this->addColumn( 'resource', 'en_name', 'varchar(45) NOT NULL' );
        $this->addColumn( 'resource', 'pt_name', 'varchar(45) NOT NULL' );
        $this->addColumn( 'resource', 'en_description', 'text' );
        $this->addColumn( 'resource', 'pt_description', 'text' );
        $this->addColumn( 'resource', 'resource_url', 'varchar(255) NOT NULL' );

        $this->dropTable( 'document' );
        $this->dropTable( 'resource_source' );

        $this->addForeignKey( 'resource_primary_language_id_language_id', 'resource', 'primary_language_id', 'language', 'id' );
        $this->addForeignKey( 'resource_secondary_language_id_language_id', 'resource', 'secondary_language_id', 'language', 'id' );

    }

    public function down()
    {
        /**
         * Schema for copyright table
         */
        $this->createTable( 'copyright', array(
                'id'        => 'pk',
                'title'     => 'varchar(155) NOT NULL',
                'year'      => 'varchar(155) NOT NULL',
                'group'     => 'varchar(155) NOT NULL',
                'license'   => 'varchar(155) NOT NULL',
            )
        );

        $this->dropColumn( 'organization', 'license' );
    }
}
