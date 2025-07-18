<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property int $id
 * @property int $user_id
 * @property int $level
 * @property int $xp
 * @property int $physical_health
 * @property int $creativity
 * @property int $knowledge
 * @property int $happiness
 * @property int $money
 * @property int $currency
 * @property string|null $last_task_completed_at
 * @property int $streak
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property Task[] $tasks
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'level', 'xp', 'physical_health', 'creativity', 'knowledge', 'happiness', 'money', 'currency', 'streak'], 'integer'],
            [['last_task_completed_at', 'created_at', 'updated_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'level' => 'Level',
            'xp' => 'XP',
            'physical_health' => 'Physical Health',
            'creativity' => 'Creativity',
            'knowledge' => 'Knowledge',
            'happiness' => 'Happiness',
            'money' => 'Money',
            'currency' => 'Currency',
            'last_task_completed_at' => 'Last Task Completed At',
            'streak' => 'Streak',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['player_id' => 'id']);
    }

    /**
     * Adds experience points to the player and handles leveling up.
     *
     * @param int $xp
     */
    public function addXp($xp)
    {
        $this->xp += $xp;
        while ($this->xp >= $this->getLevelUpXp()) {
            $this->level++;
            $this->xp -= $this->getLevelUpXp();
        }
        $this->save();
    }

    /**
     * Calculates the XP required to level up.
     *
     * @return float|int
     */
    public function getLevelUpXp()
    {
        return 100 * $this->level;
    }

    /**
     * Gets query for [[PlayerAchievements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerAchievements()
    {
        return $this->hasMany(PlayerAchievement::class, ['player_id' => 'id']);
    }

    /**
     * Awards an achievement to the player.
     *
     * @param int $achievementId
     */
    public function awardAchievement($achievementId)
    {
        $playerAchievement = new PlayerAchievement();
        $playerAchievement->player_id = $this->id;
        $playerAchievement->achievement_id = $achievementId;
        $playerAchievement->save();
    }

    /**
     * Gets query for [[PlayerQuests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerQuests()
    {
        return $this->hasMany(PlayerQuest::class, ['player_id' => 'id']);
    }

    /**
     * Assigns a quest to the player.
     *
     * @param int $questId
     */
    public function assignQuest($questId)
    {
        $playerQuest = new PlayerQuest();
        $playerQuest->player_id = $this->id;
        $playerQuest->quest_id = $questId;
        $playerQuest->save();
    }

    /**
     * Updates the daily streak.
     */
    public function updateStreak()
    {
        if ($this->last_task_completed_at === null || date('Y-m-d', strtotime('-1 day')) > $this->last_task_completed_at) {
            $this->streak = 1;
        } else {
            $this->streak++;
        }
        $this->last_task_completed_at = date('Y-m-d');
        $this->save();
    }

    /**
     * Gets query for [[PlayerItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerItems()
    {
        return $this->hasMany(PlayerItem::class, ['player_id' => 'id']);
    }

    /**
     * Adds currency to the player.
     *
     * @param int $amount
     */
    public function addCurrency($amount)
    {
        $this->currency += $amount;
        $this->save();
    }

    /**
     * Purchases an item from the shop.
     *
     * @param ShopItem $item
     * @return bool
     */
    public function purchaseItem(ShopItem $item)
    {
        if ($this->currency >= $item->price) {
            $this->currency -= $item->price;
            $playerItem = new PlayerItem();
            $playerItem->player_id = $this->id;
            $playerItem->item_id = $item->id;
            return $playerItem->save() && $this->save();
        }
        return false;
    }

    /**
     * Gets query for [[Journals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journal::class, ['player_id' => 'id']);
    }

    /**
     * Gets query for [[Goals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGoals()
    {
        return $this->hasMany(Goal::class, ['player_id' => 'id']);
    }

    /**
     * Gets query for [[Reminders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReminders()
    {
        return $this->hasMany(Reminder::class, ['player_id' => 'id']);
    }

    /**
     * Gets query for [[Habits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHabits()
    {
        return $this->hasMany(Habit::class, ['player_id' => 'id']);
    }

    /**
     * Gets query for [[Friendships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFriendships()
    {
        return $this->hasMany(Friendship::class, ['player1_id' => 'id']);
    }

    /**
     * Gets query for [[InverseFriendships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInverseFriendships()
    {
        return $this->hasMany(Friendship::class, ['player2_id' => 'id']);
    }

    /**
     * Gets query for [[Friends]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFriends()
    {
        return $this->hasMany(Player::class, ['id' => 'player2_id'])
            ->via('friendships', function ($query) {
                $query->where(['status' => 'accepted']);
            });
    }

    /**
     * Gets query for [[InverseFriends]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInverseFriends()
    {
        return $this->hasMany(Player::class, ['id' => 'player1_id'])
            ->via('inverseFriendships', function ($query) {
                $query->where(['status' => 'accepted']);
            });
    }

    /**
     * Gets all friends.
     *
     * @return array
     */
    public function getAllFriends()
    {
        return array_merge($this->friends, $this->inverseFriends);
    }
}
