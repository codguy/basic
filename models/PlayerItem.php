<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player_item".
 *
 * @property int $id
 * @property int $player_id
 * @property int $item_id
 * @property string $created_at
 *
 * @property ShopItem $item
 * @property Player $player
 */
class PlayerItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['player_id', 'item_id'], 'required'],
            [['player_id', 'item_id'], 'integer'],
            [['created_at'], 'safe'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopItem::class, 'targetAttribute' => ['item_id' => 'id']],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::class, 'targetAttribute' => ['player_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'player_id' => 'Player ID',
            'item_id' => 'Item ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(ShopItem::class, ['id' => 'item_id']);
    }

    /**
     * Gets query for [[Player]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(Player::class, ['id' => 'player_id']);
    }
}
