<?php

namespace app\controllers;

use app\models\SignupForm;
use app\models\Player;
use Yii;
use yii\web\Controller;

class SignupController extends Controller
{
    public function actionIndex()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $user = $model->signup()) {
            $player = new Player();
            $player->user_id = $user->id;
            $player->save();
            Yii::$app->user->login($user);
            return $this->goHome();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
