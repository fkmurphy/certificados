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
        return true;
    }
  
}
