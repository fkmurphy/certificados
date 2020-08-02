<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Quiz */

$this->title = 'Init Quiz';
$this->params['breadcrumbs'][] = ['label' => 'Quizzes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_init_form', [
        'model' => $model,
    ]) ?>

</div>
