<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $player_id
 * @property string $title
 * @property string|null $description
 * @property string|null $due_date
 * @property int $physical_health_effect
 * @property int $creativity_effect
 * @property int $knowledge_effect
 * @property int $happiness_effect
 * @property int $money_effect
 * @property int $completed
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Player $player
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['player_id', 'title'], 'required'],
            [['player_id', 'physical_health_effect', 'creativity_effect', 'knowledge_effect', 'happiness_effect', 'money_effect', 'completed'], 'integer'],
            [['description'], 'string'],
            [['due_date', 'created_at', 'updated_at'], 'safe'],
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
            'due_date' => 'Due Date',
            'physical_health_effect' => 'Physical Health Effect',
            'creativity_effect' => 'Creativity Effect',
            'knowledge_effect' => 'Knowledge Effect',
            'happiness_effect' => 'Happiness Effect',
            'money_effect' => 'Money Effect',
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
}
