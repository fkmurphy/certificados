<?php
    

?>
<?php foreach ($responses as $userResponse) : ?>
    <?php 
    $respuestas = $userResponse->getResponses(); 
    $correct = $quiz->getQuestions()->where(['=','quiz_id',$userResponse->quiz_id])->one()->getCorrectReponses();
    ?>
    
    <?php foreach ($respuestas as $r) : ?>
        <p><?= $r; ?> <?php if (in_array($r,$correct)) echo "Esta respuesta está bien"; ?></p>
        

    <?php endforeach; ?>
<?php endforeach; ?>