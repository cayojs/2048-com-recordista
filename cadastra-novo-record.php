<?php
    if (isset($_POST['novo_record']) && !empty($_POST['novo_record'])){
        //$novo_record = $_POST['novo_record'];
        $novo_record_limpo = preg_replace('/[^0-9]/', '',$_POST['novo_record']);

        $arquivo = "record.txt";
        $arquivo = fopen($arquivo,"w");
        //fwrite($arquivo,$novo_record);
        fwrite($arquivo,$novo_record_limpo);
        fclose($arquivo);


        $nome_recordista = "Sem nome.";
        $arquivo = "nome-recordista.txt";
        $arquivo = fopen($arquivo,"w");
        fwrite($arquivo,$nome_recordista);
        fclose($arquivo);
    }
?>