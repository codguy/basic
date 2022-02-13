<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTestDept */

$this->title = 'Create Tbl Test Dept';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Test Depts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-test-dept-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
