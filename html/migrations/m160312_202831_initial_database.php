<?php

use yii\db\Migration;

class m160312_202831_initial_database extends Migration
{
    public function up()
    {

        /**
         * Schema for document table
         */
        $this->createTable( 'document', array(
                'id'                    => 'pk',
                'primary_language_id'   => 'int NOT NULL',
                'secondary_language_id' => 'int NULL',
                'en_title'              => 'varchar(155) NOT NULL',
                'en_description'        => 'varchar(255) NOT NULL',
                'pt_title'              => 'varchar(155) NOT NULL',
                'pt_description'        => 'varchar(255) NOT NULL',
                'author'                => 'varchar(155) NOT NULL',
                'copyright_id'          => 'int NOT NULL',
                'document_type'         => 'varchar(45) NOT NULL',
            )
        );

        /**
         * Schema for organization table
         */
        $this->createTable( 'organization', array(
                'id'                => 'pk',
                'en_name'           => 'varchar(155) NOT NULL',
                'en_description'    => 'varchar(255) NOT NULL',
                'pt_name'           => 'varchar(155) NOT NULL',
                'pt_description'    => 'varchar(255) NOT NULL',
                'photo'             => 'varchar(155) NOT NULL',
            )
        );

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

        /**
         * Schema for teacher table
         */
        $this->createTable( 'teacher', array(
                'id'                => 'pk',
                'en_name'           => 'varchar(100) NOT NULL',
                'en_description'    => 'varchar(255) NOT NULL',
                'pt_name'           => 'varchar(100) NOT NULL',
                'pt_description'    => 'varchar(255) NOT NULL',
                'location'          => 'varchar(100) NOT NULL',
                'photo'             => 'varchar(255) NOT NULL',
                'organization_id'   => 'int NOT NULL',
            )
        );

        /**
         * Schema for language table
         */
        $this->createTable( 'language', array(
                'id'        => 'pk',
                'name'      => 'varchar(45) NOT NULL',
                'code'      => 'varchar(45) NOT NULL',
                'dam_ot'    => 'varchar(45) NOT NULL',
                'dam_nt'    => 'varchar(45) NOT NULL',
            )
        );

        /**
         * Schema for teaching table
         */
        $this->createTable( 'teaching', array(
                'id'                    => 'pk',
                'primary_language_id'   => 'int NOT NULL',
                'secondary_language_id' => 'int NULL',
                'en_title'              => 'varchar(155) NOT NULL',
                'pt_title'              => 'varchar(155) NOT NULL',
                'url'                   => 'varchar(255) NOT NULL',
                'teacher_id'            => 'int NOT NULL',
                'copyright_id'          => 'int NOT NULL',
                'length'                => 'varchar(45) NULL',
            )
        );

        /**
         * Schema for resource_source table
         */
        $this->createTable( 'resource_source', array(
                'id'                => 'pk',
                'resource_type_id'  => 'int NOT NULL',
                'path'              => 'varchar(255) NOT NULL',
            )
        );

        /**
         * Schema for resource table
         */
        $this->createTable( 'resource', array(
                'id'                    => 'pk',
                'resource_type_id'  => 'int NOT NULL',
                'resource_source_id'    => 'int NOT NULL',
                'resource_col'          => 'varchar(45) NOT NULL',
            )
        );

        /**
         * Schema for resource_type table
         */
        $this->createTable( 'resource_type', array(
                'id'    => 'pk',
                'name'  => 'varchar(45) NOT NULL',
            )
        );

        $this->createTable( 'nt_book', array(
                'id'            => 'pk',
                'book_en'       => 'varchar(45) NOT NULL',
                'book_pt'       => 'varchar(45) NOT NULL',
                'book_code'     => 'varchar(45) NOT NULL',
                'num_chapters'  => 'smallint NOT NULL',
            )
        );

        $this->createTable( 'ot_book', array(
                'id'            => 'pk',
                'book_en'       => 'varchar(45) NOT NULL',
                'book_pt'       => 'varchar(45) NOT NULL',
                'book_code'     => 'varchar(45) NOT NULL',
                'num_chapters'  => 'smallint NOT NULL',
            )
        );

         /**
         * Foreign Key and Indexing Declarations
         */
        $this->addForeignKey( 'document_primary_language_id_language_id', 'document', 'primary_language_id', 'language', 'id' );
        $this->addForeignKey( 'document_secondary_language_id_language_id', 'document', 'secondary_language_id', 'language', 'id' );
        $this->addForeignKey( 'document_copyright_id_copyright_id', 'document', 'copyright_id', 'copyright', 'id' );
        $this->addForeignKey( 'teacher_organization_id_organization_id', 'teacher', 'organization_id', 'organization', 'id' );
        $this->addForeignKey( 'teaching_primary_language_id_language_id', 'teaching', 'primary_language_id', 'language', 'id' );
        $this->addForeignKey( 'teaching_secondary_language_id_language_id', 'teaching', 'secondary_language_id', 'language', 'id' );
        $this->addForeignKey( 'teaching_teacher_id_teacher_id', 'teaching', 'teacher_id', 'teacher', 'id' );
        $this->addForeignKey( 'teaching_copyright_id_copyright_id', 'teaching', 'copyright_id', 'copyright', 'id' );
        $this->addForeignKey( 'resource_source_resource_type_id_resource_type_id', 'resource_source', 'resource_type_id', 'resource_type', 'id' );
        $this->addForeignKey( 'resource_resource_type_id_resource_type_id', 'resource', 'resource_type_id', 'resource_type', 'id' );
        $this->addForeignKey( 'resource_resource_source_id_resource_source_id', 'resource', 'resource_source_id', 'resource_source', 'id' );

        //Starting Data
        $ot_books = json_decode('[
  {
    "Index":1,
    "bookEN":"Genesis",
    "bookPT":"Gêneses",
    "bookCode":"Gen",
    "numChapters":50
  },
  {
      "Index":2,
    "bookEN":"Exodus",
    "bookPT":"Êxodo",
    "bookCode":"Exod",
    "numChapters":40
  },
  {
      "Index":3,
    "bookEN":"Leviticus",
    "bookPT":"Levítico",
    "bookCode":"Lev",
    "numChapters":27
  },
  {
      "Index":4,
    "bookEN":"Numbers",
    "bookPT":"Números",
    "bookCode":"Num",
    "numChapters":36
  },
  {
      "Index":5,
    "bookEN":"Deuteronomy",
    "bookPT":"Deuteronômio",
    "bookCode":"Deut",
    "numChapters":34
  },
  {
      "Index":6,
    "bookEN":"Joshua",
    "bookPT":"Josué",
    "bookCode":"Josh",
    "numChapters":24
  },
  {
      "Index":7,
    "bookEN":"Judges",
    "bookPT":"Juízes",
    "bookCode":"Judg",
    "numChapters":21
  },
  {
      "Index":8,
    "bookEN":"Ruth",
    "bookPT":"Rute",
    "bookCode":"Ruth",
    "numChapters":4
  },
  {
      "Index":9,
    "bookEN":"1 Samuel",
    "bookPT":"1 Samuel",
    "bookCode":"1Sam",
    "numChapters":31
  },
  {
      "Index":10,
    "bookEN":"2 Samuel",
    "bookPT":"2 Samuel",
    "bookCode":"2Sam",
    "numChapters":24
  },
  {
      "Index":11,
    "bookEN":"1 Kings",
    "bookPT":"1 Reis",
    "bookCode":"1Kgs",
    "numChapters":22
  },
  {
      "Index":12,
    "bookEN":"2 Kings",
    "bookPT":"2 Reis ",
    "bookCode":"2Kgs",
    "numChapters":25
  },
  {
      "Index":13,
    "bookEN":"1 Chronicles",
    "bookPT":"1 Crônica",
    "bookCode":"1Chr",
    "numChapters":29
  },
  {
      "Index":14,
    "bookEN":"2 Chronicles",
    "bookPT":"2 Crônica",
    "bookCode":"2Chr",
    "numChapters":36
  },
  {
      "Index":15,
    "bookEN":"Ezra",
    "bookPT":"Esdras",
    "bookCode":"Ezra",
    "numChapters":10
  },
  {
      "Index":16,
    "bookEN":"Nehemiah",
    "bookPT":"Neemias",
    "bookCode":"Neh",
    "numChapters":13
  },
  {
      "Index":17,
    "bookEN":"Esther",
    "bookPT":"Ester",
    "bookCode":"Esth",
    "numChapters":10
  },
  {
      "Index":18,
    "bookEN":"Job",
    "bookPT":"Jó",
    "bookCode":"Job",
    "numChapters":42
  },
  {
      "Index":19,
    "bookEN":"Psalms",
    "bookPT":"Salmos",
    "bookCode":"Ps",
    "numChapters":150
  },
  {
      "Index":20,
    "bookEN":"Proverbs",
    "bookPT":"Provérbio",
    "bookCode":"Prov",
    "numChapters":31
  },
  {
      "Index":21,
    "bookEN":"Ecclesiastes",
    "bookPT":"Eclesiastes",
    "bookCode":"Eccl",
    "numChapters":12
  },
  {
      "Index":22,
    "bookEN":"Song of Solomon",
    "bookPT":"Cânticos",
    "bookCode":"Song",
    "numChapters":8
  },
  {
      "Index":23,
    "bookEN":"Isaiah",
    "bookPT":"Isaías",
    "bookCode":"Isa",
    "numChapters":66
  },
  {
      "Index":24,
    "bookEN":"Jeremiah",
    "bookPT":"Jeremias",
    "bookCode":"Jer",
    "numChapters":52
  },
  {
      "Index":25,
    "bookEN":"Lamentations",
    "bookPT":"Lamentações",
    "bookCode":"Lam",
    "numChapters":5
  },
  {
      "Index":26,
    "bookEN":"Ezekiel",
    "bookPT":"Ezequiel",
    "bookCode":"Ezek",
    "numChapters":48
  },
  {
      "Index":27,
    "bookEN":"Daniel",
    "bookPT":"Daniel",
    "bookCode":"Dan",
    "numChapters":12
  },
  {
      "Index":28,
    "bookEN":"Hosea",
    "bookPT":"Oséias",
    "bookCode":"Hos",
    "numChapters":14
  },
  {
      "Index":29,
    "bookEN":"Joel",
    "bookPT":"Joel",
    "bookCode":"Joel",
    "numChapters":3
  },
  {
      "Index":30,
    "bookEN":"Amos",
    "bookPT":"Amós",
    "bookCode":"Amos",
    "numChapters":9
  },
  {
      "Index":31,
    "bookEN":"Obadiah",
    "bookPT":"Obadias",
    "bookCode":"Obad",
    "numChapters":1
  },
  {
      "Index":32,
    "bookEN":"Jonah",
    "bookPT":"Jonas",
    "bookCode":"Jonah",
    "numChapters":4
  },
  {
      "Index":33,
    "bookEN":"Micah",
    "bookPT":"Miquéias",
    "bookCode":"Mic",
    "numChapters":7
  },
  {
      "Index":34,
    "bookEN":"Nahum",
    "bookPT":"Naum",
    "bookCode":"Nah",
    "numChapters":3
  },
  {
      "Index":35,
    "bookEN":"Habakkuk",
    "bookPT":"Habacuque",
    "bookCode":"Hab",
    "numChapters":3
  },
  {
      "Index":36,
    "bookEN":"Zephaniah",
    "bookPT":"Sofonias",
    "bookCode":"Zeph",
    "numChapters":3
  },
  {
      "Index":37,
    "bookEN":"Haggai",
    "bookPT":"Ageu",
    "bookCode":"Hag",
    "numChapters":2
  },
  {
      "Index":38,
    "bookEN":"Zechariah",
    "bookPT":"Zacarias",
    "bookCode":"Zech",
    "numChapters":14
  },
  {
      "Index":39,
    "bookEN":"Malachi",
    "bookPT":"Malaquias",
    "bookCode":"Mal",
    "numChapters":4
  }
]');
        foreach( $ot_books as $book )
        {
            $model = new \app\models\OtBook();
            $model->book_en         = $book->bookEN;
            $model->book_pt         = $book->bookPT;
            $model->book_code       = $book->bookCode;
            $model->num_chapters    = $book->numChapters;
            $model->save();
        }

        $nt_books = json_decode('[
  {
    "Index":1,
    "bookEN":"Matthew",
    "bookPT":"Mateus",
    "bookCode":"Matt",
    "numChapters":28
  },
  {
    "Index":2,
    "bookEN":"Mark",
    "bookPT":"Marcos",
    "bookCode":"Mark",
    "numChapters":16
  },
  {
    "Index":3,
    "bookEN":"Luke",
    "bookPT":"Lucas",
    "bookCode":"Luke",
    "numChapters":24
  },
  {
    "Index":4,
    "bookEN":"John",
    "bookPT":"João",
    "bookCode":"John",
    "numChapters":21
  },
  {
    "Index":5,
    "bookEN":"Acts",
    "bookPT":"Atos",
    "bookCode":"Acts",
    "numChapters":28
  },
  {
    "Index":6,
    "bookEN":"Romans",
    "bookPT":"Romanos",
    "bookCode":"Rom",
    "numChapters":16
  },
  {
    "Index":7,
    "bookEN":"1 Corinthians",
    "bookPT":"1 Corintios",
    "bookCode":"1Cor",
    "numChapters":16
  },
  {
    "Index":8,
    "bookEN":"2 Corinthians",
    "bookPT":"2 Corintios",
    "bookCode":"2Cor",
    "numChapters":13
  },
  {
    "Index":9,
    "bookEN":"Galatians",
    "bookPT":"Gálatas",
    "bookCode":"Gal",
    "numChapters":6
  },
  {
    "Index":10,
    "bookEN":"Ephesians",
    "bookPT":"Efésios",
    "bookCode":"Eph",
    "numChapters":6
  },
  {
    "Index":11,
    "bookEN":"Philippians",
    "bookPT":"Filipenses",
    "bookCode":"Phil",
    "numChapters":4
  },
  {
    "Index":12,
    "bookEN":"Colossians",
    "bookPT":"Colessenses",
    "bookCode":"Col",
    "numChapters":4
  },
  {
    "Index":13,
    "bookEN":"1 Thessalonians",
    "bookPT":"1 Tessaloniceses",
    "bookCode":"1Thess",
    "numChapters":5
  },
  {
    "Index":14,
    "bookEN":"2 Thessalonians",
    "bookPT":"2 Tessaloniceses",
    "bookCode":"2Thess",
    "numChapters":3
  },
  {
    "Index":15,
    "bookEN":"1 Timothy",
    "bookPT":"1 Timóteo",
    "bookCode":"1Tim",
    "numChapters":6
  },
  {
    "Index":16,
    "bookEN":"2 Timothy",
    "bookPT":"2 Timóteo",
    "bookCode":"2Tim",
    "numChapters":4
  },
  {
    "Index":17,
    "bookEN":"Titus",
    "bookPT":"Titos",
    "bookCode":"Titus",
    "numChapters":3
  },
  {
    "Index":18,
    "bookEN":"Philemon",
    "bookPT":"Filimom",
    "bookCode":"Phlm",
    "numChapters":1
  },
  {
    "Index":19,
    "bookEN":"Hebrews",
    "bookPT":"Hebreus",
    "bookCode":"Heb",
    "numChapters":13
  },
  {
    "Index":20,
    "bookEN":"James",
    "bookPT":"Tiago",
    "bookCode":"Jas",
    "numChapters":5
  },
  {
    "Index":21,
    "bookEN":"1 Peter",
    "bookPT":"1 Pedro",
    "bookCode":"1Pet",
    "numChapters":5
  },
  {
    "Index":22,
    "bookEN":"2 Peter",
    "bookPT":"2 Pedro",
    "bookCode":"2Pet",
    "numChapters":3
  },
  {
    "Index":23,
    "bookEN":"1 John",
    "bookPT":"1 João",
    "bookCode":"1John",
    "numChapters":5
  },
  {
    "Index":24,
    "bookEN":"2 John",
    "bookPT":"2 João",
    "bookCode":"2John",
    "numChapters":1
  },
  {
    "Index":25,
    "bookEN":"3 John",
    "bookPT":"3 João",
    "bookCode":"3John",
    "numChapters":1
  },
  {
    "Index":26,
    "bookEN":"Jude",
    "bookPT":"Judas",
    "bookCode":"Jude",
    "numChapters":1
  },
  {
    "Index":27,
    "bookEN":"Revelation",
    "bookPT":"Apocalipse",
    "bookCode":"Rev",
    "numChapters":22
  }
]');

        foreach( $nt_books as $book )
        {
            $model = new \app\models\NtBook();
            $model->book_en         = $book->bookEN;
            $model->book_pt         = $book->bookPT;
            $model->book_code       = $book->bookCode;
            $model->num_chapters    = $book->numChapters;
            $model->save();
        }
    }

    public function down()
    {
        $this->dropTable( 'resource' );
        $this->dropTable( 'teaching' );
        $this->dropTable( 'teacher' );
        $this->dropTable( 'organization' );
        $this->dropTable( 'document' );
        $this->dropTable( 'copyright' );
        $this->dropTable( 'language' );
        $this->dropTable( 'resource_source' );
        $this->dropTable( 'resource_type' );
        $this->dropTable( 'nt_books' );
        $this->dropTable( 'ot_books' );

        return true;
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
