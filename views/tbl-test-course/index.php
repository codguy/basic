<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblTestCourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Test Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-test-course-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbl Test Course', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'dept',
            'duration',
            'fee',
            //'created_on',
            //'created_by_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblTestCourse $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
