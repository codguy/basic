<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_test_dept}}".
 *
 * @property int $id
 * @property string $name
 * @property string $created_on
 * @property int|null $created_by_id
 *
 * @property TblTestUser $createdBy
 * @property TblTestCourse[] $tblTestCourses
 * @property TblTestStudent[] $tblTestStudents
 */
class TblTestDept extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_test_dept}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_on'], 'required'],
            [['created_on'], 'safe'],
            [['created_by_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
     * Gets query for [[TblTestCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestCourses()
    {
        return $this->hasMany(TblTestCourse::className(), ['dept' => 'id']);
    }

    /**
     * Gets query for [[TblTestStudents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestStudents()
    {
        return $this->hasMany(TblTestStudent::className(), ['dept' => 'id']);
    }
}
