<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_test_student}}".
 *
 * @property int $id
 * @property string $name
 * @property int $dept
 * @property int $course
 * @property string $address
 * @property string|null $father
 * @property string|null $mother
 * @property int|null $roll_no
 * @property int|null $phone_no
 * @property string|null $section
 * @property int|null $cgpa
 * @property string $created_on
 * @property int|null $created_by_id
 *
 * @property TblTestCourse $course0
 * @property TblTestUser $createdBy
 * @property TblTestDept $dept0
 * @property TblTestMark[] $tblTestMarks
 */
class TblTestStudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_test_student}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'dept', 'course', 'address', 'created_on'], 'required'],
            [['dept', 'course', 'roll_no', 'phone_no', 'cgpa', 'created_by_id'], 'integer'],
            [['created_on'], 'safe'],
            [['name', 'address', 'father', 'mother'], 'string', 'max' => 50],
            [['section'], 'string', 'max' => 3],
            [['course'], 'exist', 'skipOnError' => true, 'targetClass' => TblTestCourse::className(), 'targetAttribute' => ['course' => 'id']],
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
            'course' => 'Course',
            'address' => 'Address',
            'father' => 'Father',
            'mother' => 'Mother',
            'roll_no' => 'Roll No',
            'phone_no' => 'Phone No',
            'section' => 'Section',
            'cgpa' => 'Cgpa',
            'created_on' => 'Created On',
            'created_by_id' => 'Created By ID',
        ];
    }

    /**
     * Gets query for [[Course0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse0()
    {
        return $this->hasOne(TblTestCourse::className(), ['id' => 'course']);
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
     * Gets query for [[TblTestMarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestMarks()
    {
        return $this->hasMany(TblTestMark::className(), ['student' => 'id']);
    }
}
