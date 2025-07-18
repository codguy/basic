<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "achievement".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $icon
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PlayerAchievement[] $playerAchievements
 */
class Achievement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'achievement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'icon'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'icon'], 'string', 'max' => 255],
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
            'icon' => 'Icon',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[PlayerAchievements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerAchievements()
    {
        return $this->hasMany(PlayerAchievement::class, ['achievement_id' => 'id']);
    }
}
