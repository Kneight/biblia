<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResourceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resource-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'resource_type_id') ?>

    <?= $form->field($model, 'organization_id') ?>

    <?= $form->field($model, 'hit_counter') ?>

    <?php // echo $form->field($model, 'teacher_id') ?>

    <?php // echo $form->field($model, 'primary_language_id') ?>

    <?php // echo $form->field($model, 'secondary_language_id') ?>

    <?php // echo $form->field($model, 'en_name') ?>

    <?php // echo $form->field($model, 'pt_name') ?>

    <?php // echo $form->field($model, 'en_description') ?>

    <?php // echo $form->field($model, 'pt_description') ?>

    <?php // echo $form->field($model, 'resource_url') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
