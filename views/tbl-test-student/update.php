<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTestStudent */

$this->title = 'Update Tbl Test Student: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Test Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-test-student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
