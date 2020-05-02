<html>
<head>
    <title>Sucesso</title>
    <link rel="shortcut icon" href="imagens/favicon.ico">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=500px, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="js/jquery.js"></script>

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
                    $(".pontuacao-do-campeao b").html(valorRecord);
                }
            });

            $.ajax({
                url : "nome-recordista.txt?t="+n,
                dataType: "text",
                success : function (nomeRecordista){
                    $(".nome-do-campeao b").html(nomeRecordista);
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
<body class="pagina-sucesso">

<h1>SUCESSO!</h1>
<p>Você é o novo recordista!</p>

<div class="dados-recordista">
    <p class="nome-do-campeao">Nome: <b></b></p>
    <p class="pontuacao-do-campeao">Record: <b></b></p>
</div>

<script>
    setTimeout(function() {
        window.location.href = "https://www.cayojs.com.br/testes/2048/";
    }, 5000);
</script>

</body>
</html>