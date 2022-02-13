<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_test_course}}".
 *
 * @property int $id
 * @property string $name
 * @property int $dept
 * @property int $duration
 * @property int $fee
 * @property string $created_on
 * @property int|null $created_by_id
 *
 * @property TblTestUser $createdBy
 * @property TblTestDept $dept0
 * @property TblTestStudent[] $tblTestStudents
 * @property TblTestSubject[] $tblTestSubjects
 */
class TblTestCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_test_course}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'dept', 'duration', 'fee', 'created_on'], 'required'],
            [['dept', 'duration', 'fee', 'created_by_id'], 'integer'],
            [['created_on'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['dept'], 'exist', 'skipOnError' => true, 'targetClass' => TblTestDept::className(), 'targetAttribute' => ['dept' => 'id']],
            [['created_by_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblTestUser::className(), 'targetAttribute' => ['created_by_id' => 'id']],
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
            'dept' => 'Dept',
            'duration' => 'Duration',
            'fee' => 'Fee',
            'created_on' => 'Created On',
            'created_by_id' => 'Created By ID',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(TblTestUser::className(), ['id' => 'created_by_id']);
    }

    /**
     * Gets query for [[Dept0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDept0()
    {
        return $this->hasOne(TblTestDept::className(), ['id' => 'dept']);
    }

    /**
     * Gets query for [[TblTestStudents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestStudents()
    {
        return $this->hasMany(TblTestStudent::className(), ['course' => 'id']);
    }

    /**
     * Gets query for [[TblTestSubjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestSubjects()
    {
        return $this->hasMany(TblTestSubject::className(), ['course' => 'id']);
    }
}
