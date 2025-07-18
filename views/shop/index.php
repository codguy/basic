<?php

use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Shop';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description:ntext',
            'price',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {buy}',
                'buttons' => [
                    'buy' => function ($url, $model, $key) {
                        return Html::a('Buy', ['buy', 'id' => $model->id], [
                            'class' => 'btn btn-success btn-xs',
                            'data' => [
                                'confirm' => 'Are you sure you want to buy this item?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
