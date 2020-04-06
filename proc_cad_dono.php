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

    $objdono = new dono(); //instaciando o objeto pet em cadpet
    $objdono->nome = strtoupper(addslashes(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING)));
    $objdono->rg = strtoupper(addslashes(filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_NUMBER_INT)));
    $objdono->tel = strtoupper(addslashes(filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT)));

    //chama função para escrever no banco na tabela dono
    insert_db_cadastroDONO($objdono->nome, $objdono->rg, $objdono->tel, $conn);

    //verifica os dados e executa a inserção
    if ($inserir->execute()) {
        $_SESSION['msg'] = "<p style = 'color: BLUE;'> CADASTRO REALIZADO </p>"; //Gera mensagem de cadastro OK
        header("Location: cadastrodono.php"); //direciona a mensagem para a pagina cadastropet.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE CADASTRO </p>"; //Gera mensagem de erro no cadastro
        header("Location: cadastrodono.php"); //direciona a mensagem para a pagina cadastropet.php
    }
} else {
    $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO DE ACESSO DE PAGINA </p>"; //Gera mensagem de erro de pagina
    header("Location: cadastrodono.php"); //direciona a mensagem para a pagina cadastropet.php
}
