<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_test_subject}}".
 *
 * @property int $id
 * @property string $name
 * @property int $credits
 * @property int $course
 * @property string $sub_code
 * @property string $created_on
 * @property int|null $created_by_id
 *
 * @property TblTestCourse $course0
 * @property TblTestUser $createdBy
 * @property TblTestMark[] $tblTestMarks
 */
class TblTestSubject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_test_subject}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'credits', 'course', 'sub_code', 'created_on'], 'required'],
            [['credits', 'course', 'created_by_id'], 'integer'],
            [['created_on'], 'safe'],
            [['name', 'sub_code'], 'string', 'max' => 50],
            [['sub_code'], 'unique'],
            [['course'], 'exist', 'skipOnError' => true, 'targetClass' => TblTestCourse::className(), 'targetAttribute' => ['course' => 'id']],
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
            'credits' => 'Credits',
            'course' => 'Course',
            'sub_code' => 'Sub Code',
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
     * Gets query for [[TblTestMarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTestMarks()
    {
        return $this->hasMany(TblTestMark::className(), ['subject' => 'id']);
    }
}
