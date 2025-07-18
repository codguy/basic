<?php

use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Friendships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friendship-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'player1.user.username',
                'label' => 'Player 1',
            ],
            [
                'attribute' => 'player2.user.username',
                'label' => 'Player 2',
            ],
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{accept} {decline} {delete}',
                'buttons' => [
                    'accept' => function ($url, $model, $key) {
                        if ($model->status === 'pending' && $model->player2_id === Yii::$app->user->identity->player->id) {
                            return Html::a('Accept', ['accept', 'id' => $model->id], [
                                'class' => 'btn btn-success btn-xs',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                        }
                    },
                    'decline' => function ($url, $model, $key) {
                        if ($model->status === 'pending' && $model->player2_id === Yii::$app->user->identity->player->id) {
                            return Html::a('Decline', ['decline', 'id' => $model->id], [
                                'class' => 'btn btn-danger btn-xs',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                        }
                    },
                ],
            ],
        ],
    ]); ?>

</div>
