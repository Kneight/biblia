<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nt_books".
 *
 * @property integer $id
 * @property string $boon_en
 * @property string $book_pt
 * @property string $book_code
 * @property integer $num_chapters
 */
class NtBook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nt_book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_chapters'], 'integer'],
            [['book_en', 'book_pt', 'book_code'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_en' => 'Book En',
            'book_pt' => 'Book Pt',
            'book_code' => 'Book Code',
            'num_chapters' => 'Num Chapters',
        ];
    }
}
