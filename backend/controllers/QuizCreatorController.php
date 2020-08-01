<?php

namespace backend\controllers;

use Yii;
use common\models\Quiz;
use backend\models\QuestionsArray;
use common\models\searchs\QuizSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuizController implements the CRUD actions for Quiz model.
 */
class QuizCreatorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Creates a new Quiz model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionIndex()
    {
        $quiz = new Quiz();
        $questions = new QuestionsArray();

        if (Yii::$app->request->post()) {

            $transaction = Yii::$app->db->beginTransaction();
            try{
                $quiz->status = 1;
                if($quiz->load(Yii::$app->request->post()) && $quiz->save()){
                    $questions->load(Yii::$app->request->post());//&& 
                    $questions->save($quiz);
                }
                $transaction->commit();
                //$transaction->rollback();
                return $this->render('visor', ['quiz' => $quiz,'questions' => $questions]);
            }catch (\Exception $e){
                $transaction->rollBack();
                throw $e;
            }
            
        }

        return $this->render('createQuiz', [
            'questions' => $questions,
            'quiz' => $quiz
        ]);
    }


    /**
     * Finds the Quiz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quiz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quiz::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
