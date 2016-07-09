<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeachingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teachings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaching-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Teaching', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'en_title',
            'teacherName',
            'organizationName',
//            'primary_language_id',
//            'secondary_language_id',
            'length',
            'created_at:date',
            'hit_counter',
//            'pt_title',
            // 'url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
