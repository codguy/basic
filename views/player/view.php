<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Player $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="player-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Add Friend', ['/friendship/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'level',
            'xp',
            'physical_health',
            'creativity',
            'knowledge',
            'happiness',
            'money',
            'currency',
            'streak',
            'last_task_completed_at',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h2>Achievements</h2>
    <ul>
        <?php foreach ($model->playerAchievements as $playerAchievement): ?>
            <li><?= $playerAchievement->achievement->name ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Quests</h2>
    <ul>
        <?php foreach ($model->playerQuests as $playerQuest): ?>
            <li><?= $playerQuest->quest->name ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Items</h2>
    <ul>
        <?php foreach ($model->playerItems as $playerItem): ?>
            <li><?= $playerItem->item->name ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Friends</h2>
    <ul>
        <?php foreach ($model->getAllFriends() as $friend): ?>
            <li><?= Html::a($friend->user->username, ['/player/view', 'id' => $friend->id]) ?></li>
        <?php endforeach; ?>
    </ul>

</div>
