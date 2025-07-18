<?php

namespace app\controllers;

use app\models\Friendship;
use app\models\Player;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FriendshipController implements the CRUD actions for Friendship model.
 */
class FriendshipController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Friendship models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Friendship::find()->where(['or', ['player1_id' => Yii::$app->user->identity->player->id], ['player2_id' => Yii::$app->user->identity->player->id]]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Friendship model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new Friendship();
        $model->player1_id = Yii::$app->user->identity->player->id;
        $model->player2_id = $id;

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Friend request sent.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to send friend request.');
        }

        return $this->redirect(['/player/view', 'id' => $id]);
    }

    /**
     * Accepts a friend request.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAccept($id)
    {
        $model = $this->findModel($id);
        $model->status = 'accepted';
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Declines a friend request.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDecline($id)
    {
        $model = $this->findModel($id);
        $model->status = 'declined';
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Friendship model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Friendship model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Friendship the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Friendship::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
