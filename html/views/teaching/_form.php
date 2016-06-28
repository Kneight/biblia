<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Teaching */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teaching-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $languageArray = ArrayHelper::map(\app\models\Language::find()->orderBy('name')->all(), 'id', 'name') ?>
    <?= $form->field($model, 'primary_language_id')->dropDownList($languageArray, ['prompt' => '---- Select Language ----'])->label('Primary Language') ?>

    <?= $form->field($model, 'secondary_language_id')->dropDownList($languageArray, ['prompt' => '---- Select Language ----'])->label('Secondary Language') ?>

    <?= $form->field($model, 'en_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pt_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'en_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pt_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php $organizationArray = ArrayHelper::map(\app\models\Organization::find()->orderBy('en_name')->all(), 'id', 'en_name') ?>
    <?= $form->field($model, 'organization_id')->dropDownList($organizationArray, ['prompt' => '---- Select Organization ----'])->label('Organization') ?>

    <?php $teacherArray = ArrayHelper::map(\app\models\Teacher::find()->orderBy('organization_id, en_name')->all(), 'id', 'en_name', 'organization.en_name') ?>
    <?= $form->field($model, 'teacher_id')->dropDownList($teacherArray, ['prompt' => '---- Select Teacher ----'])->label('Teacher') ?>

    <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
