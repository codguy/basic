<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_test_user}}".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $roll_id
 * @property string|null $dob
 * @property string|null $created_on
 * @property int|null $created_by_id
 *
 * @property TblTestCourse[] $tblTestCourses
 * @property TblTestDept[] $tblTestDepts
 * @property TblTestMark[] $tblTestMarks
 * @property TblTestStudent[] $tblTestStudents
 * @property TblTestSubject[] $tblTestSubjects
 */
class TblTestUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_test_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'roll_id'], 'required'],
            [['roll_id', 'created_by_id'], 'integer'],
            [['dob', 'created_on'], 'safe'],
            [['name', 'email', 'password'], 'string', 'max' => 50],
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
            'email' => 'Email',
            'password' => 'Password',
            'roll_id' => 'Roll ID',
            'dob' => 'Dob',
            'created_on' => 'Created On',
            'created_by_id' => 'Created By ID',
        ];
    }

    /**
     * Gets query for [[TblTestCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestCourses()
    {
        return $this->hasMany(TblTestCourse::className(), ['created_by_id' => 'id']);
    }

    /**
     * Gets query for [[TblTestDepts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestDepts()
    {
        return $this->hasMany(TblTestDept::className(), ['created_by_id' => 'id']);
    }

    /**
     * Gets query for [[TblTestMarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestMarks()
    {
        return $this->hasMany(TblTestMark::className(), ['created_by_id' => 'id']);
    }

    /**
     * Gets query for [[TblTestStudents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestStudents()
    {
        return $this->hasMany(TblTestStudent::className(), ['created_by_id' => 'id']);
    }

    /**
     * Gets query for [[TblTestSubjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestSubjects()
    {
        return $this->hasMany(TblTestSubject::className(), ['created_by_id' => 'id']);
    }
}
