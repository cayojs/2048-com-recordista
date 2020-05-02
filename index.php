<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>2048</title>

    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="imagens/favicon.ico">

    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="format-detection" content="telephone=no" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">

    <script src="js/jquery.js"></script>
    <script src="js/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function(){

            var d = new Date();
            var n = d.getTime();

            $.ajax({
                url : "record.txt?t="+n,
                dataType: "text",
                success : function (valorRecord){
                    localStorage.setItem("bestScore", valorRecord);
                    localStorage.setItem("pontos", "");
                    $(".best-container").html(valorRecord);
                }
            });

            $.ajax({
                url : "nome-recordista.txt?t="+n,
                dataType: "text",
                success : function (nomeRecordista){
                    $(".nome-recordista span").html(nomeRecordista);
                }
            });

        });
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-53735404-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-53735404-1');
    </script>

</head>

<body class="game-container">

<div class="container">
    <div class="heading">
        <div class="scores-container">
            <div class="score-container">0</div>
            <div class="best-container">0</div>
            <a class="restart-button">NOVO JOGO</a>
        </div>
    </div>

    <div class="nome-recordista"><span></span></div>

    <div class="game-container">
        <div class="game-message">
            <p></p>
            <div class="lower">
                <a class="keep-playing-button">CONTINUE</a>
                <a class="retry-button">JOGAR NOVAMENTE</a>
            </div>
        </div>
        <div class="grid-container">
            <div class="grid-row">
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
            </div>
            <div class="grid-row">
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
            </div>
            <div class="grid-row">
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
            </div>
            <div class="grid-row">
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
            </div>
        </div>
        <div class="tile-container"></div>
    </div>

</div>

<script src="js/bind_polyfill.js"></script>
<script src="js/classlist_polyfill.js"></script>
<script src="js/animframe_polyfill.js"></script>
<script src="js/keyboard_input_manager.js"></script>
<script src="js/html_actuator.js"></script>
<script src="js/grid.js"></script>
<script src="js/tile.js"></script>
<script src="js/local_storage_manager.js"></script>
<script src="js/game_manager.js"></script>
<script src="js/application.js"></script>

<form method="POST" id="formulario_record"><input readonly="readonly" id="novo_record" type="text" name="novo_record"></form>

<script src="js/scripts-nome-recordista.js"></script>
<div class='popup-record'>
    <h3>Você bateu o Record do Jogo!</h3>
    <p>Deixe seu nome salvo como novo Recordista!</p>
    <form method='POST' id='formulario_recordista'></form>
</div>

<div class='record-quebrado'><h2>RECORD QUEBRADO!!!</h2></div>
<div class="parabens"><div class="parabens-animacao"></div></div>

<!--<h2 style="text-align: center" class="melhor-pontuacao">MELHOR PONTUAÇÃO: <b>-</b></h2>-->

</body>
</html>