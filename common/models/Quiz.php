<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\db\Expression;
/**
 * This is the model class for table "quiz".
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Question[] $questions
 * @property UserResponse[] $userResponses
 */
class Quiz extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['title', 'created_at', 'updated_at'], 'required'],
            [['title'], 'required'],
            [['status', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status'], 'integer'],
            [['updated_at','created_at'],'date'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['quiz_id' => 'id']);
    }

    /**
     * Gets query for [[UserResponses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserResponses()
    {
        return $this->hasMany(UserResponse::className(), ['quiz_id' => 'id']);
    }
}
