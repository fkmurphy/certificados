<?php
namespace backend\models;
use yii\base\Model;

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

    public function save(){
        foreach ($this->questions as $elem) {
            $model = new Question();
            $question = $elem->question;
            $type = $elem->type;
            foreach ($responses as $response) {
                
            }
        }
        
    }
    

}