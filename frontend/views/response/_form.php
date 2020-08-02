<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Quiz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quiz-form">
    <h3><?= $quiz->title ?></h3>
    <?php $form = ActiveForm::begin(); ?>

    <?php
     $count = 0;
     foreach ($quiz->questions as $question) : ?>
        <p><?php
            echo $form->field($userResponse,'responses['.$count.']')->checkBoxList($question->getResponses()); 
            $count++;
        ?></p>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
