<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Quiz */

$this->title =  $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Quizzes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quiz-view">

    <h1><span style="font-weight:bold">Cuestionario </span><?= Html::encode($this->title) ?></h1>
    
    <?php
        foreach ($model->questions as $question ) : 
            $correct = $question->getCorrectReponses();
            ?>
            <h3>Pregunta: <?=$question->question?></h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Respuestas</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Es correcta </th>
                    </tr>
                </thead>
                <tbody>
                <?php // filas ?> 
                <?php foreach ($question->getResponses() as $response ) : ?>
                    <tr>
                        <th scope="row"><?= $response; ?></th>
                        <td><?=$question->type ?></td>
                        <td>
                            <?php 
                                if(in_array($response,$correct)){
                                    echo "Es correcta (icon tilde verde)";
                                } 
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?> 
                </tbody>
            </table>                       
    <?php endforeach; ?>


</div>
