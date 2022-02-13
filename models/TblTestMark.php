<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_test_mark}}".
 *
 * @property int $id
 * @property int $student
 * @property int $subject
 * @property string $mark
 * @property string $total
 * @property int $sub_code
 * @property string $created_on
 * @property int|null $created_by_id
 *
 * @property TblTestUser $createdBy
 * @property TblTestStudent $student0
 * @property TblTestSubject $subject0
 */
class TblTestMark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_test_mark}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student', 'subject', 'mark', 'total', 'sub_code', 'created_on'], 'required'],
            [['student', 'subject', 'sub_code', 'created_by_id'], 'integer'],
            [['created_on'], 'safe'],
            [['mark', 'total'], 'string', 'max' => 50],
            [['subject'], 'exist', 'skipOnError' => true, 'targetClass' => TblTestSubject::className(), 'targetAttribute' => ['subject' => 'id']],
            [['student'], 'exist', 'skipOnError' => true, 'targetClass' => TblTestStudent::className(), 'targetAttribute' => ['student' => 'id']],
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
            'student' => 'Student',
            'subject' => 'Subject',
            'mark' => 'Mark',
            'total' => 'Total',
            'sub_code' => 'Sub Code',
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
     * Gets query for [[Student0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent0()
    {
        return $this->hasOne(TblTestStudent::className(), ['id' => 'student']);
    }

    /**
     * Gets query for [[Subject0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject0()
    {
        return $this->hasOne(TblTestSubject::className(), ['id' => 'subject']);
    }
}
