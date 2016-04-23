<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResourceType */

$this->title = 'Update Resource Type: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Resource Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resource-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
