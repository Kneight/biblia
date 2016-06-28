<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LicenseType */

$this->title = 'Create License Type';
$this->params['breadcrumbs'][] = ['label' => 'License Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="license-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
