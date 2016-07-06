<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'en_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'en_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pt_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pt_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

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

    <?php $organizationArray = ArrayHelper::map(\app\models\Organization::find()->orderBy('en_name')->all(), 'id', 'en_name') ?>
    <?= $form->field($model, 'organization_id')->dropDownList($organizationArray, ['prompt' => '---- Select Organization ----'])->label('Organization') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
