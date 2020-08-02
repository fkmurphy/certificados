<?php
namespace backend\models;
use yii\base\Model;
use common\models\Quiz;
use common\models\Question;
use Yii;

class QuestionsArray extends Model
{
    /**
     * @var array virtual attribute for keeping emails
     */
    public $questions;


    public function rules(){
        return [
            ['questions','required'],
        ];
    }

    public function attributes(){
        return [
            'questions',
        ];
    }

    public function save(Quiz $quiz){
        $transaction = Yii::$app->db->beginTransaction();
        try{
            foreach ($this->questions as $elem) {
                $model = new Question();
                $question = $elem['question'];
                $type = $elem['type'];
                $model->quiz_id = $quiz->id;
                $responses = "";
                $correct_responses = "";
                foreach ($elem['responses'] as $elemResponse) {
                    $string = $elemResponse['response']."/";
                    if ($elemResponse['correct_response'] == 1){
                        $correct_responses.= $string;
                    }
                    $responses .= $string;
                }
                
                $model->question = $question;
                $model->type = $type; // tipos
                $model->responses = substr($responses,0,-1);
                $model->correct_responses = substr($correct_responses,0,-1);
                $model->status = 1; // falta.
                $model->save();
                
            }
            $transaction->commit();
        } catch (Exception $e)    {
            $transaction->rollback();
        }
    }
    

}