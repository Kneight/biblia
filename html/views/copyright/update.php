<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Copyright */

$this->title = 'Update Copyright: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Copyrights', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="copyright-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
