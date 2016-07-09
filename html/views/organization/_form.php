<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Organization */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'en_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'en_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pt_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pt_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_upload')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/png, image/jpg, image/jpeg'],
        'pluginOptions' => [
            'showPreview' => true,
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
//            'overwriteInitial'=>false,
//            'initialCaption'=>"Current Photo",
            'initialPreviewAsData'=>true,
            'initialPreview'=>[
                $model->photo,
            ],
        ]
    ]); ?>

    <?php $licenseArray = ArrayHelper::map(\app\models\LicenseType::find()->orderBy('name')->all(), 'id', 'name') ?>
    <?= $form->field($model, 'license_type_id')->dropDownList($licenseArray, ['prompt' => '---- Select License Type ----'])->label('License Type') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
