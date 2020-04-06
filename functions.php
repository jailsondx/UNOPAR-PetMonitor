<?php

include_once 'conexao.php';

class pet
{

    public $nome;
    public $tipo;
    public $idade;
    public $sexo;
    public $id_gps;
    public $data;
    public $nomedono;
}

class dono
{

    public $nome;
    public $rg;
    public $tel;
}

function insert_db_cadastroPET($nome, $tipo, $idade, $sexo, $id_gps, $data, $nome_dono, $conn)
{

    //inserir no BD
    $cad_valores = "INSERT INTO pet (nome, tipo, idade, sexo, id_gps, data, nome_dono) VALUE (:nome, :tipo, :idade, :sexo, :id_gps, :data, :nome_dono)"; //função inserir do mysql
    $inserir = $conn->prepare($cad_valores);

    //bindParam evitar SQLinject
    $inserir->bindParam(':nome', $nome);
    $inserir->bindParam(':tipo', $tipo);
    $inserir->bindParam(':idade', $idade);
    $inserir->bindParam(':sexo', $sexo);
    $inserir->bindParam(':id_gps', $id_gps);
    $inserir->bindParam(':data', $data);
    $inserir->bindParam(':nome_dono', $nome_dono);


    //verifica os dados e executa a inserção
    if ($inserir->execute()) {
        $_SESSION['msg'] = "<p style = 'color: BLUE;'> CADASTRO REALIZADO </p>"; //Gera mensagem de cadastro OK
        header("Location: cadastropet.php"); //direciona a mensagem para a pagina cadastropet.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE CADASTRO DO PET<br>VERIFIQUE OS DADOS </p>"; //Gera mensagem de erro no cadastro
        header("Location: cadastropet.php"); //direciona a mensagem para a pagina cadastropet.php
    }
}

function insert_db_cadastroDONO($nome, $rg, $tel, $conn)
{

    //inserir no BD
    $cad_valores = "INSERT INTO dono (nome, rg, tel) VALUE (:nome, :rg, :tel)"; //função inserir do mysql
    $inserir = $conn->prepare($cad_valores);

    //bindParam evitar SQLinject
    $inserir->bindParam(':nome', $nome);
    $inserir->bindParam(':rg', $rg);
    $inserir->bindParam(':tel', $tel);


    //verifica os dados e executa a inserção
    if ($inserir->execute()) {
        $_SESSION['msg'] = "<p style = 'color: BLUE;'> CADASTRO REALIZADO </p>"; //Gera mensagem de cadastro OK
        header("Location: cadastrodono.php"); //direciona a mensagem para a pagina cadastropet.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE CADASTRO DO CLIENTE<br>VERIFIQUE OS DADOS </p>"; //Gera mensagem de erro no cadastro
        header("Location: cadastrodono.php"); //direciona a mensagem para a pagina cadastropet.php
    }
}

function insert_db_localizacao($id_local, $lat, $lon, $data_gps, $conn)
{

    $local_valores = "INSERT INTO posicao (id_local, lat, lon, data_gps) VALUE (:id_local, :lat, :lon, :data_gps)";
    $inserir = $conn->prepare($local_valores);

    $inserir->bindParam(':id_local', $id_local);
    $inserir->bindParam(':lat', $lat);
    $inserir->bindParam(':lon', $lon);
    $inserir->bindParam(':data_gps', $data_gps);

    //verifica os dados e executa a inserção
    if ($inserir->execute()) {
        $_SESSION['msg'] = "<p style = 'color: BLUE;'> CADASTRO REALIZADO </p>"; //Gera mensagem de cadastro OK
        header("Location: cadastropet.php"); //direciona a mensagem para a pagina cadastropet.php
    } else {
        $_SESSION['msg'] = "<p style = 'color: RED;'> ERRO NA TENTATIVA DE CADASTRO DO ID<br>VERIFIQUE OS DADOS </p>"; //Gera mensagem de erro no cadastro
        header("Location: cadastropet.php"); //direciona a mensagem para a pagina cadastropet.php
    }
}

function pesquisapet($nome, $data_ini, $conn)
{
    $valores = "SELECT * FROM pet WHERE nome LIKE '%$nome%' LIMIT 5";
    $resultado = $conn->prepare($valores);
    $resultado->execute();

    while ($row_result = $resultado->fetch(PDO::FETCH_ASSOC)) {
        echo "Nome: " . $row_result['nome'] . "<br>";
        echo "Tipo: " . $row_result['tipo'] . "<br>";
        echo "Idade: " . $row_result['idade'] . " ANOS<br>";
        echo "Sexo: " . $row_result['sexo'] . "<br>";
        echo "Localizador: " . $row_result['id_gps'] . "<br>";
        echo "Dono: " . $row_result['nome_dono'] . "<br>";
        echo "<br>";
        echo "<FORM method='POST' action='historico.php'> <INPUT type='hidden' name='id' value='" . $row_result['id_gps'] . "'> <INPUT type='hidden' name='data_ini' value='" . $data_ini . "'> <INPUT type='submit' id='submitbtn' class='btn btn-info btn-lg' name='historico' value='Ver Historico do PET'></form><br>";
        echo "____________________________<br> <br>";
    }
}

function exibedatas($historico, $conn)
{
    if ($historico) {
        $id_pet = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $data_ini = filter_input(INPUT_POST, 'data_ini', FILTER_SANITIZE_STRING);
        $valores = "SELECT * FROM posicao WHERE id_local LIKE '$id_pet' LIMIT 5";

        //Seleciona os registros
        $resultado = $conn->prepare($valores);
        $resultado->execute();

        $cont = 0;
        echo "<br>";
        while ($row_result = $resultado->fetch(PDO::FETCH_ASSOC)) {
            if ($row_result['data_gps']) {
                //$data = date('d/m/Y', strtotime(' -' . $cont . ' days'));
                $data = date('d/m/Y', strtotime($data_ini.' -' . $cont . ' days'));
                //echo "<id='maps' style = 'color: red;'>Data: </id>" . $data;
                echo "<form method='POST' action='mapa.php' target='_blank'><input type=hidden name='id' value='" . $row_result['id'] . "'><input type=submit class='btn btn-warning btn-lg' name='maps' value='" . $data . "'></form>";
                $cont++;
            } else {
                header('Location:index.html');
            }
        }
    } else { }
}

function LatJS($id, $conn)
{
    $valores = "SELECT lat FROM posicao WHERE id LIKE $id";

    //Seleciona os registros
    $resultado = $conn->prepare($valores);
    $resultado->execute();

    $row_result = $resultado->fetch(PDO::FETCH_ASSOC);
    $lat = $row_result['lat'];

    return $lat;
}

function LonJS($id, $conn)
{
    $valores = "SELECT lon FROM posicao WHERE id LIKE $id";

    //Seleciona os registros
    $resultado = $conn->prepare($valores);
    $resultado->execute();

    $row_result = $resultado->fetch(PDO::FETCH_ASSOC);
    $lon = $row_result['lon'];

    return $lon;
}
