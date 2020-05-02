<?php

    // SALVA O NOME
    if (isset($_POST['novo_nome']) && !empty($_POST['novo_nome'])){
        $nome_recordista = $_POST['novo_nome'];
        $lixo = array("<", ">", "script", "/", "?");
        $limpa_lixo   = array("", "", "", "", "");
        $nome_recordista_limpo = str_replace($lixo, $limpa_lixo, $nome_recordista);
        $nome_final = substr($nome_recordista_limpo,0,25);
        $arquivo = "nome-recordista.txt";
        $arquivo = fopen($arquivo,"w");
        fwrite($arquivo,$nome_final);
        fclose($arquivo);
        echo "<h1 style='color:green;'>NOME ALTERADO.</h1>";
    } else{
        echo "<h1 style='color:red;'>NOME NÃO ALTERADO.</h1>";
    }


    // SALVA O RECORD
    if (isset($_POST['novo_record']) && !empty($_POST['novo_record'])){

        //$novo_record = $_POST['novo_record'];

        $novo_record_limpo = preg_replace('/[^0-9]/', '',$_POST['novo_record']);


        // VALIDA SE SÓ VEIO NÚMEROS
        //if (preg_match('/[^0-9]/', $_POST['novo_record']) > 0){
            //echo 'Só é permitido números.';
        //} else{
            //echo 'Validou!';
        //}

        $arquivo = "record.txt";
        $arquivo = fopen($arquivo,"w");
        //fwrite($arquivo,$novo_record);
        fwrite($arquivo,$novo_record_limpo);
        fclose($arquivo);
        echo "<h1 style='color:green;'>RECORD ALTERADO.</h1>";
    } else{
        echo "<h1 style='color:red;'>RECORD NÃO ALTERADO.</h1>";
    }


?>

<script>
    setTimeout(function() {
        window.location.href = "https://www.cayojs.com.br/testes/2048/editar.php";
    }, 5000);
</script>