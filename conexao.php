<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'unopar_pet');

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
//Check Conexão
if (!$conn) {
    die("ERRO AO CONECTAR COM O BD MYSQLi " . mysqli_connect_erro());
} else {
    //echo "CONEXÃO COM BD MYSQLi REALIZADA COM SUCESSO";
}
