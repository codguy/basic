<?php

namespace app\controllers;

use app\models\Player;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * LeaderboardController displays the leaderboard.
 */
class LeaderboardController extends Controller
{
    /**
     * Displays the leaderboard.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Player::find()->orderBy(['level' => SORT_DESC, 'xp' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
