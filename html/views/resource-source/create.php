<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResourceSource */

$this->title = 'Create Resource Source';
$this->params['breadcrumbs'][] = ['label' => 'Resource Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-source-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
