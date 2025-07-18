<?php

use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Leaderboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leaderboard-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user.username',
                'label' => 'Player',
            ],
            'level',
            'xp',
        ],
    ]); ?>

</div>
