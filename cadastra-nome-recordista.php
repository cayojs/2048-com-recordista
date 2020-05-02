<?php

    if (isset($_POST['nome_recordista']) && !empty($_POST['nome_recordista'])){

        $nome_recordista = $_POST['nome_recordista'];

        $lixo = array("<", ">", "script", "/", "?");
        $limpa_lixo   = array("", "", "", "", "");
        $nome_recordista_limpo = str_replace($lixo, $limpa_lixo, $nome_recordista);

        $nome_final = substr($nome_recordista_limpo,0,25);

        $arquivo = "nome-recordista.txt";
        $arquivo = fopen($arquivo,"w");
        fwrite($arquivo,$nome_final);
        fclose($arquivo);
        
    }

?>