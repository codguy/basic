<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "habit".
 *
 * @property int $id
 * @property int $player_id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Player $player
 * @property HabitLog[] $habitLogs
 */
class Habit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'habit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['player_id', 'title', 'description'], 'required'],
            [['player_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
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
     * Gets query for [[HabitLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHabitLogs()
    {
        return $this->hasMany(HabitLog::class, ['habit_id' => 'id']);
    }
}
