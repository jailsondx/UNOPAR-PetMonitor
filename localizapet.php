<?php
include 'conexao.php';
include 'functions.php';
?>

<HTML>

<HEAD>
    <META charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">
    <TITLE>Pesquisar PET</TITLE>
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
                <H1>Pesquisa de PET</H1>

                <FORM method="POST" action="">
                    Nome:<INPUT pattern=".{3,25}" type="text" name="nome" id="locplaceholder" class="form-control" placeholder="MINIMO DE 3 LETRAS" autocomplete="off">
                    Data Inicial:<INPUT type="date" name="data_ini" id="locplaceholder" class="form-control">
                    Data Final:<INPUT type="date" name="data_fim" id="locplaceholder" class="form-control">
                    <h6>as datas devem estar em um intervalo de até 5 dias</h6>
                    <INPUT type="submit" class="btn btn-success btn-lg" name="pesquisa" value="Pesquisar">
                    <a href="index.html"><INPUT type="button" class="btn btn-danger btn-lg" name="voltar" value="Voltar"></a>
                </FORM>

                <?php
                //addslashes previne envio de dados por rackers
                //FILTER_SANITIZE filtra o tipo de dado recebido
                //strtoupper deixa tudo em CAIXA ALTA
                $nome = strtoupper(addslashes(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING)));
                $data_ini = strtoupper(addslashes(filter_input(INPUT_POST, 'data_ini', FILTER_SANITIZE_STRING)));
                $data_fim = strtoupper(addslashes(filter_input(INPUT_POST, 'data_fim', FILTER_SANITIZE_STRING)));

                //Verifica se a variavel $nome tem valor para exibir os registros
                if ($nome && $data_ini) {
                    //Seleciona os registros
                   echo pesquisapet($nome, $data_ini, $conn);
                    
                } else {
                    echo "<img src = 'imagens/uni.png' width='50%'>";
                }
                ?>
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