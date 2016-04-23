<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResourceSourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resource Sources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-source-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Resource Source', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'resource_type_id',
            'path',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
