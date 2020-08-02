<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use Yii;
use yii\db\Expression;
/**
 * This is the model class for table "user_response".
 *
 * @property int $id
 * @property string $response
 * @property int $status
 * @property int $user_id
 * @property int $question_id
 * @property int $quiz_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Question $question
 * @property Quiz $quiz
 * @property User $user
 */
class UserResponse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['response', 'user_id', 'question_id', 'quiz_id'], 'required'],
            [['status', 'user_id', 'question_id', 'quiz_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status', 'user_id', 'question_id', 'quiz_id'], 'integer'],
            [['created_at', 'updated_at'],'date'],
            [['response'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quiz::className(), 'targetAttribute' => ['quiz_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'response' => 'Response',
            'status' => 'Status',
            'user_id' => 'User ID',
            'question_id' => 'Question ID',
            'quiz_id' => 'Quiz ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * Gets query for [[Quiz]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuiz()
    {
        return $this->hasOne(Quiz::className(), ['id' => 'quiz_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
