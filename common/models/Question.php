<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\db\Expression;

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
    public function behaviors(){
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
            [['question', 'correct_responses', 'responses', 'quiz_id'], 'required'],
            [['status', 'quiz_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status', 'quiz_id','type'], 'integer'],
            [['updated_at','created_at'],'date'],
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
            'question' => 'Pregunta',
            'correct_responses' => 'Respuestas correctas',
            'responses' => 'Respuestas',
            'status' => 'Status',
            'type' => 'Tipo',
            'quiz_id' => 'Quiz ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCorrectReponses(){
        return explode('/',$this->correct_responses);
    }
    
    public function getResponses(){
        return explode('/',$this->responses);
    }

    public static function getTypes(){
        return [
            0 => 'Verdadero/Falso',
            1 => 'Multiple respuestas',
            2 => 'Una respuesta',
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
