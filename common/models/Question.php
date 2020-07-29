<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $question
 * @property string $correct_responses
 * @property string $responses
 * @property int $status
 * @property int $quiz_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Quiz $quiz
 * @property UserResponse[] $userResponses
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question', 'correct_responses', 'responses', 'quiz_id', 'created_at', 'updated_at'], 'required'],
            [['status', 'quiz_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status', 'quiz_id', 'created_at', 'updated_at'], 'integer'],
            [['question', 'correct_responses', 'responses'], 'string', 'max' => 255],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quiz::className(), 'targetAttribute' => ['quiz_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'correct_responses' => 'Correct Responses',
            'responses' => 'Responses',
            'status' => 'Status',
            'quiz_id' => 'Quiz ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * Gets query for [[UserResponses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserResponses()
    {
        return $this->hasMany(UserResponse::className(), ['question_id' => 'id']);
    }
}
