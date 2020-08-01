<?php

use yii\helpers\Html;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\MultipleInputColumn;

/* @var $this yii\web\View */
/* @var $model common\models\Quiz */

$this->title = 'Crear una encuesta';
$this->params['breadcrumbs'][] = ['label' => 'Quizzes', 'url' => ['quiz/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_create_quiz_form', [
        'quiz' => $quiz,
        'questions' => $questions
    ]) ?>

</div>
