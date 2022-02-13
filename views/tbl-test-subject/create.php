<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTestSubject */

$this->title = 'Create Tbl Test Subject';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Test Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-test-subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
