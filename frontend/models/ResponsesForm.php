<?php
namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\models\Quiz;
use common\models\UserResponse;
use Yii;
use kartik\mpdf\Pdf;

class ResponsesForm extends Model
{
    
    public $responses;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['responses','required'],
        ];
    }

    public function attributes(){
        return [
            'responses',
        ];
    }
    public function save(Quiz $quiz){
        //0 pregunta 1
            // respuestas [0,2]
        //1 pregunta 2
            // respuestas [0]
        $quizQuestions = $quiz->questions;
        $cont = 0;
        foreach ($this->responses as $questResponses) {
            $userResponse = new UserResponse();
            $userResponse->quiz_id = $quiz->id;
            $userResponse->status = 1;
            $userResponse->user_id = 1;
            $question = $quizQuestions[$cont];
            $cont++;
            $userResponse->question_id = $question->id;
            $realResponses = $question->getResponses();
            $formatUserResponses = "";
            foreach ($questResponses as $response) {
                $formatUserResponses .= $realResponses[$response]."/";
            }
            $userResponse->response = substr($formatUserResponses,0,-1);
            $userResponse->save();
        }
        return true;
    }
  
}
