<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player_quest".
 *
 * @property int $id
 * @property int $player_id
 * @property int $quest_id
 * @property int $completed
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Player $player
 * @property Quest $quest
 */
class PlayerQuest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player_quest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['player_id', 'quest_id'], 'required'],
            [['player_id', 'quest_id', 'completed'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::class, 'targetAttribute' => ['player_id' => 'id']],
            [['quest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quest::class, 'targetAttribute' => ['quest_id' => 'id']],
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
            'quest_id' => 'Quest ID',
            'completed' => 'Completed',
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

    /**
     * Gets query for [[Quest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuest()
    {
        return $this->hasOne(Quest::class, ['id' => 'quest_id']);
    }
}
