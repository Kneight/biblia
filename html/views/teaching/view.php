<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Teaching */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teachings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaching-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'primary_language_id',
            'secondary_language_id',
            'en_title',
            'pt_title',
            'url:url',
            'teacher_id',
            'length',
            'organization_id',
            'hit_counter',
            'created_at:date',
        ],
    ]) ?>

</div>
