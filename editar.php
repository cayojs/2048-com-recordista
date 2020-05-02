<html>
<head>
    <title>Alterar Record</title>
    <link rel="shortcut icon" href="imagens/favicon.ico">
    <meta name="viewport" content="width=500px, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="js/jquery.js"></script>
    
    <script>
        $(document).ready(function(){

            var d = new Date();
            var n = d.getTime();

            $.ajax({
                url : "nome-recordista.txt?t="+n,
                dataType: "text",
                success : function (nomeRecordista){
                    $(".nome span").html(nomeRecordista);
                }
            });

            $.ajax({
                url : "record.txt?t="+n,
                dataType: "text",
                success : function (valorRecord){
                    localStorage.setItem("bestScore", valorRecord);
                    localStorage.setItem("pontos", "");
                    $(".record span").html(valorRecord);
                }
            });

        });
    </script>

    <style>
        body{
            padding: 20px;
            box-sizing: border-box;
            background-color: #dee5ee;
        }
        p{
            font-weight: 600;
            font-size: 30px;
            margin: 0 0 15px 0;
        }
        form{
            widows: 100%;
            background-color: #fff;
            border-radius: 3px;
            padding: 20px;
            box-sizing: border-box;
            box-shadow: 0 2px 3px rgba(0,0,0,.3);
        }
        form label{
            color: #2196f3;
            font-size: 20px;
            margin: 0 0 5px 0;
            font-weight: 700;
            display: inline-block;
        }
        form input[type="text"]{
            width: 100%;
            height: 50px;
            margin: 0 0 15px 0;
            outline: none;
            padding: 0 5px 0 10px;
            font-size: 14px !important;
            font-weight: 700;
            font-family: 'Open Sans',sans-serif;
            color: #757575;
            border-radius: 3px;
            border: none;
            box-sizing: border-box;
            box-shadow: 0 0 0 1px #ddd;
        }
        form input[type="submit"]{
            outline: none;
            font-size: 18px;
            font-family: 'Open Sans',sans-serif;
            border: none;
            background-color: #4caf50;
            border-radius: 5px;
            font-weight: 700;
            color: #fff;
            margin: 0;
            -webkit-appearance: none;
            padding: 5px 20px 5px 20px;
            cursor: pointer;
        }
    </style>

</head>
<body>

<p class="nome">Record: <span>- -</span></p>

<p class="record">Record: <span>- -</span></p>

<form method="POST" action="alterarcao-forcada.php">
    <span><label for="novo_nome">Nome:</label><input type="text" id="novo_nome" name="novo_nome" placeholder="Nome:" value=""></span>
    <span><label for="novo_record">Rercord:</label><input type="text" id="novo_record" name="novo_record" placeholder="Rercord:" value=""></span>
    <input type='submit' value='SALVAR'>
</form>

</body>
</html>