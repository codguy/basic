<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reminder".
 *
 * @property int $id
 * @property int $player_id
 * @property string $title
 * @property string $description
 * @property string $remind_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Player $player
 */
class Reminder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reminder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['player_id', 'title', 'description', 'remind_at'], 'required'],
            [['player_id'], 'integer'],
            [['description'], 'string'],
            [['remind_at', 'created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'description' => 'Description',
            'remind_at' => 'Remind At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
