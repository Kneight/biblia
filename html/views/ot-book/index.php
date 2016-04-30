<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OtBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ot Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ot-book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ot Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'book_en',
            'book_pt',
            'book_code',
            'num_chapters',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
