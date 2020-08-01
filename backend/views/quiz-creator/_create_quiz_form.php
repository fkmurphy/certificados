<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\MultipleInputColumn;
/* @var $this yii\web\View */
/* @var $model common\models\Quiz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quiz-form">

    <?php  $form = ActiveForm::begin([
    'enableAjaxValidation'      => false,
    'enableClientValidation'    => false,
    'validateOnChange'          => false,
    'validateOnSubmit'          => true,
    'validateOnBlur'            => false,
    ]); ?>

    <?= $form->field($quiz, 'title')->textInput(['maxlength' => true]) ?>
    <?php echo $form->field($questions, 'questions')->widget(MultipleInput::className(), [
        'max'               => 6,
        'min'               => 1, // should be at least 2 rows
        'allowEmptyList'    => false,
        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        'columns' => [
            [
                'name' => 'question',
                'title' => 'Texto de la pregunta',
            ],
            [
                'name' => 'type',
                'type' => 'dropDownList',
                'title' => 'Tipo de respuesta',
                'defaultValue' => 1,
                'items' => [
                    1 => 'User 1',
                    2 => 'User 2'
                ]
            ],
            [
                'name' => 'responses',
                'title' => 'Respuestas',
                'type'  => MultipleInput::class,
                'options' => [
                    //'attributeOptions' => $atributos,
                    'columns' => [
                        [
                            'title' => 'Es correcta?',
                            'name' => 'right',
                            'type' => MultipleInputColumn::TYPE_CHECKBOX
                        ],
                        [
                            'title' => 'Respuesta',
                            'name' => 'answer'
                        ]
                    ]
                ]
            ]

        ]
    ])
    ->label(false);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Crear', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
