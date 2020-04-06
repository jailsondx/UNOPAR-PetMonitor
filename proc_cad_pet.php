<?php

session_start();
include 'conexao.php';
include 'functions.php';
date_default_timezone_set('America/Fortaleza');

//Verifica se o BOTÃO CADASTRAR foi clicado
$cadastro = filter_input(INPUT_POST, 'cadastro', FILTER_SANITIZE_STRING);

//SE botão ativado $cadastro recebe cadastro e roda o IF, SE NÃO, roda o ELSE
//addslashes previne envio de dados por rackers
//FILTER_SANITIZE filtra o tipo de dado recebido
//strtoupper deixa tudo em CAIXA ALTA

if ($cadastro) {

    $objpet = new pet(); //instaciando o objeto pet em cadpet
    $objpet->nome = strtoupper(addslashes(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING)));
    $objpet->tipo = strtoupper(addslashes(filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING)));
    $objpet->idade = strtoupper(addslashes(filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT)));
    $objpet->sexo = strtoupper(addslashes(filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING)));
    $objpet->id_gps = strtoupper(addslashes(filter_input(INPUT_POST, 'id_gps', FILTER_SANITIZE_NUMBER_INT)));
    $objpet->nomedono = strtoupper(addslashes(filter_input(INPUT_POST, 'nomedono', FILTER_SANITIZE_STRING)));
    $objpet->data = date('Y-m-d H:i:s');

    $id_local = $objpet->id_gps;

    //chama função para escrever no banco na tabela pet
    insert_db_cadastroPET($objpet->nome, $objpet->tipo, $objpet->idade, $objpet->sexo, $objpet->id_gps, $objpet->data, $objpet->nomedono, $conn);

    for ($cont = 0; $cont < 5; $cont++) {
        //Gera os digitos finais das localizações
        $geraLat = rand(716632, 650069);
        $geraLon = rand(300262, 417039);

        //Armazena nas variaveis
        $lat = "-3." . $geraLat;
        $lon = "-40." . $geraLon;

        //$data_gps = date('d/m/Y H:i:s', strtotime('-'.$cont.' days')); //contador subtração do dia
        //Armazena a data/hora atual
        $data_gps = date('Y-m-d H:i:s');

        //chama função para escrever no banco na tabela posicao
        insert_db_localizacao($id_local, $lat, $lon, $data_gps, $conn);
    }

    //verifica os dados e executa a inserção
    if ($inserir->execute()) {
        $_SESSION['msg'] = "<p style = 'color: BLUE;'> CADASTRO REALIZADO </p>"; //Gera mensagem de cadastro OK
        header("Location: cadastropet.php"); //direciona a mensagem para a pagina cadastropet.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE CADASTRO </p>"; //Gera mensagem de erro no cadastro
        header("Location: cadastropet.php"); //direciona a mensagem para a pagina cadastropet.php
    }
} else {
    $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO DE ACESSO DE PAGINA </p>"; //Gera mensagem de erro de pagina
    header("Location: cadastropet.php"); //direciona a mensagem para a pagina cadastropet.php
}
