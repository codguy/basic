<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblTestStudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Test Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-test-student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbl Test Student', ['create'], ['class' => 'btn btn-success']) ?>
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
            'course',
            'address',
            //'father',
            //'mother',
            //'roll_no',
            //'phone_no',
            //'section',
            //'cgpa',
            //'created_on',
            //'created_by_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblTestStudent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
