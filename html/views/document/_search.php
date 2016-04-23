<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'primary_language_id') ?>

    <?= $form->field($model, 'secondary_language_id') ?>

    <?= $form->field($model, 'en_title') ?>

    <?= $form->field($model, 'en_description') ?>

    <?php // echo $form->field($model, 'pt_title') ?>

    <?php // echo $form->field($model, 'pt_description') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'copyright_id') ?>

    <?php // echo $form->field($model, 'document_type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
