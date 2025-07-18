<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "habit_log".
 *
 * @property int $id
 * @property int $habit_id
 * @property string $date
 * @property string $created_at
 *
 * @property Habit $habit
 */
class HabitLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'habit_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['habit_id', 'date'], 'required'],
            [['habit_id'], 'integer'],
            [['date', 'created_at'], 'safe'],
            [['habit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Habit::class, 'targetAttribute' => ['habit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'habit_id' => 'Habit ID',
            'date' => 'Date',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Habit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHabit()
    {
        return $this->hasOne(Habit::class, ['id' => 'habit_id']);
    }
}
