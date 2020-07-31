<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserResponse */

$this->title = 'Create User Response';
$this->params['breadcrumbs'][] = ['label' => 'User Responses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-response-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
