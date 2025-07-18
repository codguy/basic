<?php

namespace app\controllers;

use app\models\ShopItem;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ShopController implements the CRUD actions for ShopItem model.
 */
class ShopController extends Controller
{
    /**
     * Lists all ShopItem models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ShopItem::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShopItem model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Buys an item from the shop.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionBuy($id)
    {
        $model = $this->findModel($id);
        $player = Yii::$app->user->identity->player;

        if ($player->purchaseItem($model)) {
            Yii::$app->session->setFlash('success', 'You have successfully purchased the item.');
        } else {
            Yii::$app->session->setFlash('error', 'You do not have enough currency to purchase this item.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ShopItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ShopItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopItem::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
