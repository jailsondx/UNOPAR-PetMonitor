<?php
session_start();
include 'conexao.php';
include 'functions.php';
?>

<HTML>

<HEAD>
    <META charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">
    <TITLE>Historico do PET</TITLE>
</HEAD>

<BODY>
    <table>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td height="30%" id="quandrobranco">
                <H1>Historico do PET</H1>
                <?php
                if (isset($_SESSION['msg'])) { //verifica se tem valor na MSG, SE for TRUE...
                    echo $_SESSION['msg']; //...Imprime a MSG...
                    unset($_SESSION['msg']); //...apaga o valor da MSG
                }
                ?>
                <?php
                //addslashes previne envio de dados por rackers
                //FILTER_SANITIZE filtra o tipo de dado recebido
                $historico = filter_input(INPUT_POST, 'historico', FILTER_SANITIZE_STRING);
                echo exibedatas($historico, $conn);
                ?>
                <br>
                <a href="localizapet.php"><INPUT type="button" class="btn btn-danger btn-lg" name="voltar" value="Voltar"></a>
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</BODY>

</HTML>