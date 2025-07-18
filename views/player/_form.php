<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Player $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="player-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'physical_health')->textInput() ?>

    <?= $form->field($model, 'creativity')->textInput() ?>

    <?= $form->field($model, 'knowledge')->textInput() ?>

    <?= $form->field($model, 'happiness')->textInput() ?>

    <?= $form->field($model, 'money')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
