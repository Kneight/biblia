<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Teaching */

$this->title = 'Create Teaching';
$this->params['breadcrumbs'][] = ['label' => 'Teachings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaching-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
