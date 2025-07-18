<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_item".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $price
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PlayerItem[] $playerItems
 */
class ShopItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[PlayerItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerItems()
    {
        return $this->hasMany(PlayerItem::class, ['item_id' => 'id']);
    }
}
