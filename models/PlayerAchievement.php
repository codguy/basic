<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player_achievement".
 *
 * @property int $id
 * @property int $player_id
 * @property int $achievement_id
 * @property string $created_at
 *
 * @property Achievement $achievement
 * @property Player $player
 */
class PlayerAchievement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player_achievement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['player_id', 'achievement_id'], 'required'],
            [['player_id', 'achievement_id'], 'integer'],
            [['created_at'], 'safe'],
            [['achievement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Achievement::class, 'targetAttribute' => ['achievement_id' => 'id']],
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
            'achievement_id' => 'Achievement ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Achievement]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAchievement()
    {
        return $this->hasOne(Achievement::class, ['id' => 'achievement_id']);
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
