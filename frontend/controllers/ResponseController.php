<?php

namespace frontend\controllers;

use Yii;
use common\models\Quiz;
use common\models\UserResponse;
use frontend\models\ResponsesForm;
use common\models\searchs\QuizSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuizController implements the CRUD actions for Quiz model.
 */
class ResponseController extends Controller
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
     * Lists all Quiz models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuizSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     /**
     * Displays a single Quiz model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionGo($id)
    {
        $newResponse = new ResponsesForm();
        $quiz = $this->findQuiz($id);
        if ($newResponse->load(Yii::$app->request->post()) && $newResponse->save($quiz)) {
            return $this->redirect(['results', 'id' =>$id]);
        }

        return $this->render('response_quiz', [
            'quiz' => $quiz,
            'userResponse' => $newResponse
        ]);
    }

    public function actionResults($id){
        $quiz = $this->findQuiz($id);
        $responses = $this->findResponses($id,Yii::$app->user->getId());
        return $this->render('results',[
            'quiz' => $quiz,
            'responses' => $responses
        ]);
    }
    /**
     * Creates a new Quiz model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionInit()
    {
        return $this->redirect(['quiz-creator/index']);
    }

    /**
     * Deletes an existing Quiz model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $questions = $model->questions;
            foreach ($questions as $elem) {
                $elem->delete();
            }
            $model->delete();
            $transaction->commit();

        } catch (Exception $e){
            $transaction->rollback();

        }
        return $this->redirect(['index']);
    }

        /**
     * Finds the Quiz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quiz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findQuiz($id)
    {
        if (($model = Quiz::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findResponses($quizId, $userId){
        if ($responses = UserResponse::find()->where(['=','quiz_id',$quizId])
                ->where(['=','user_id',$userId])->all()){
            return $responses;
        }
        throw new NotFoundHttpException("No results.");
    }
}


