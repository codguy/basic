<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTestUser */

$this->title = 'Create Tbl Test User';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Test Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-test-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
