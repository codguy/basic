<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\TblTestUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-test-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'roll_id')->textInput() ?>

    <?= $form->field($model, 'dob')->widget(DatePicker::widget([
    'name' => 'dp_5',
    'type' => DatePicker::TYPE_INLINE,
    'value' => '1-jan-1900',
    'type' => DatePicker::TYPE_INLINE,
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'multidate' => true
    ]
]))?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'created_by_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
