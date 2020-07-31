<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Italianno">
<style type="text/css">
    body {
        background-image: url("images/cert.png");
        background-image-resize: 6;
        font-family: 'Italianno';

    }
    #title{
        text-align:center;
        font-size: 80px;
        position:absolute;
        top:60mm;
        left:0;
        right:0;
    }
    #name{
        font-family: 'Times New Romance';
        font-weight: bold;
        font-size:40px;
        text-align:center;
        position:absolute;
        top:115mm;
        left:0;
        right:0;
    }
    .description{
        font-family: 'Times New Romance';
        text-align:center;
        position:absolute;
        top:140mm;
        left:0;
        right:0;
    }
    #init{
        font-size:20px;
    }
    #course{
        font-size:30px;
    }
    #signleft{
        font-family: 'Times New Romance';
        font-weight: bold;
        font-size:40px;
        text-align:left;
        position:absolute;
        bottom:40mm;
        left:110mm;
        right:auto;
    }
    #signright{
        font-family: 'Times New Romance';
        font-weight: bold;
        font-size:40px;
        text-align:right;
        position:absolute;
        bottom:40mm;
        left:auto;
        right:110mm;
    }
    #signright p , #signleft p  {
        font-size:15px;
        font-weight:0;
        text-align:center;
        margin:0px;
    }
    #signright hr, #signleft hr{
        padding-top:0px;
        margin-top:0px;
    }
    #signright img , #signleft img {
        max-width:200px;
    }
</style>

<p id="title"><?= $title ?></p>
<p id="name"><?= $nombre ?></p>
<div class="description">
    <p id="init"><?= $messageDescription ?></p>
    <p id="course"><?= $courseName ?></p>
</div>

<div id="signleft">
    <img src="images/sign.png" alt="">
    <hr>
    <p><?=$nameSignerOne?></p>
</div>
<div id="signright">
    <img src="images/sign.png" alt="">
    <hr>
    <p><?=$nameSignerTwo?></p>
</div>
