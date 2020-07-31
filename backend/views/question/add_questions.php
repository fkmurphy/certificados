<?php

use yii\helpers\Html;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\MultipleInputColumn;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = 'Create Question';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
 $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'questions')->widget(MultipleInput::className(), [
        'max'               => 6,
        'min'               => 1, // should be at least 2 rows
        'allowEmptyList'    => false,
        'enableGuessTitle'  => true,
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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>