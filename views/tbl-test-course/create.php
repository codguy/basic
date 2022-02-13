<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTestCourse */

$this->title = 'Create Tbl Test Course';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Test Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-test-course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
