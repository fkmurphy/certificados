<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Italianno">

</head>
<body>
<p style="font-family:Italianno" id="title"><?= $title ?></p>
<p id="name"><?= $nombre ?></p>
<div class="description">
    <p id="init"><?= $messageDescription ?></p>
    <p id="course"><?= $courseName ?></p>
</div>

<div id="signleft">
    <img style="max-width:200px; margin-bottom:0;" src="images/sign.png" alt="">
    <p style="font-size:12px; text-align:center; border-top:1px
             solid black;padding-top:5px; margin-top:0px;">
        <?=$nameSignerOne?>
    </p>
</div>
<div id="signright">
    <img  style="max-width:200px" src="images/sign.png" alt="">
    <p style="font-size:12px; text-align:center; border-top:1px 
            solid black;padding-top:5px; margin-top:0px;">
        <?=$nameSignerTwo?>
    </p>
</div>
</body>
</html>



