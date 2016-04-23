<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResourceType */

$this->title = 'Create Resource Type';
$this->params['breadcrumbs'][] = ['label' => 'Resource Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
