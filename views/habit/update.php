<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Habit $model */

$this->title = 'Update Habit: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Habits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="habit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
