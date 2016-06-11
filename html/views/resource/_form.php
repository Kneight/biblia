<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resource */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resource-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'resource_type_id')->textInput() ?>

    <?= $form->field($model, 'resource_source_id')->textInput() ?>

    <?= $form->field($model, 'organization_id')->textInput() ?>

    <?= $form->field($model, 'hit_counter')->textInput() ?>

    <?= $form->field($model, 'teacher_id')->textInput() ?>

    <?= $form->field($model, 'primary_language_id')->textInput() ?>

    <?= $form->field($model, 'secondary_language_id')->textInput() ?>

    <?= $form->field($model, 'en_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pt_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'en_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pt_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'resource_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
