<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "friendship".
 *
 * @property int $id
 * @property int $player1_id
 * @property int $player2_id
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Player $player1
 * @property Player $player2
 */
class Friendship extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'friendship';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['player1_id', 'player2_id'], 'required'],
            [['player1_id', 'player2_id'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['player1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::class, 'targetAttribute' => ['player1_id' => 'id']],
            [['player2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::class, 'targetAttribute' => ['player2_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'player1_id' => 'Player1 ID',
            'player2_id' => 'Player2 ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Player1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer1()
    {
        return $this->hasOne(Player::class, ['id' => 'player1_id']);
    }

    /**
     * Gets query for [[Player2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer2()
    {
        return $this->hasOne(Player::class, ['id' => 'player2_id']);
    }
}
