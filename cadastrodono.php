<?php
session_start();
include_once 'conexao.php';
?>

<HTML>

<HEAD>
    <META charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">
    <TITLE>Cadastro Cliente</TITLE>
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
            <td height="60%" id="quandrobranco">
                <H1>Cadastro de Cliente</H1><br>
                <?php
                if (isset($_SESSION['msg'])) { //verifica se tem valor na MSG, SE for TRUE...
                    echo $_SESSION['msg']; //...Imprime a MSG...
                    unset($_SESSION['msg']); //...apaga o valor da MSG
                }
                ?>

                <FORM method="POST" action="proc_cad_dono.php">
                    <TABLE border='0' id='cadform'>
                        <tr>
                            <td>
                                <p>Nome:
                            </td>
                            <td width='30'></td>
                            <td>
                                <p><INPUT type="text" id="cadplaceholder" class="form-control" name="nome" size="5" maxlength="20" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>RG:
                            </td>
                            <td width='30'></td>
                            <td>
                                <p><INPUT type="text" id="cadplaceholder" class="form-control" name="rg" maxlength="12" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Número de Contato:
                            </td>
                            <td width='30'></td>
                            <td>
                                <p><INPUT type="text" id="cadplaceholder" class="form-control" name="tel" maxlength="11" autocomplete="off">
                            </td>
                        </tr>                       
                    </TABLE>
                    <br><br>
                    <INPUT type="submit" class="btn btn-success btn-lg" name="cadastro" value="Cadastro">
                    <a href="index.html"><INPUT type="button" class="btn btn-danger btn-lg" name="voltar" value="Voltar"></a>
                </FORM>
                </div>
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