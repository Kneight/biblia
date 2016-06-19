<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Resource */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resource-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php $typeArray = ArrayHelper::map(\app\models\ResourceType::find()->orderBy('name')->all(), 'id', 'name') ?>
    <?= $form->field($model, 'resource_type_id')->dropDownList($typeArray, ['prompt' => '---- Select Resource Type ----'])->label('Resource Type') ?>

    <?php $organizationArray = ArrayHelper::map(\app\models\Organization::find()->orderBy('en_name')->all(), 'id', 'en_name') ?>
    <?= $form->field($model, 'organization_id')->dropDownList($organizationArray, ['prompt' => '---- Select Organization ----'])->label('Organization') ?>

    <?php $teacherArray = ArrayHelper::map(\app\models\Teacher::find()->orderBy('en_name')->all(), 'id', 'en_name', 'organization.en_name') ?>
    <?= $form->field($model, 'teacher_id')->dropDownList($teacherArray, ['prompt' => '---- Select Teacher ----'])->label('Teacher') ?>

    <?php $languageArray = ArrayHelper::map(\app\models\Language::find()->orderBy('name')->all(), 'id', 'name') ?>
    <?= $form->field($model, 'primary_language_id')->dropDownList($languageArray, ['prompt' => '---- Select Language ----'])->label('Primary Language') ?>

    <?= $form->field($model, 'secondary_language_id')->dropDownList($languageArray, ['prompt' => '---- Select Language ----'])->label('Secondary Language') ?>

    <?= $form->field($model, 'en_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pt_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'en_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pt_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file_upload')->fileInput() ?>
    <?= $form->field($model, 'resource_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
