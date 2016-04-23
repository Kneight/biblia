<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Teaching */

$this->title = 'Update Teaching: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teachings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teaching-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
