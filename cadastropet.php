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
    <TITLE>Cadastro de PET</TITLE>
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
                <H1>Cadastro de PET</H1><br>
                <?php
                if (isset($_SESSION['msg'])) { //verifica se tem valor na MSG, SE for TRUE...
                    echo $_SESSION['msg']; //...Imprime a MSG...
                    unset($_SESSION['msg']); //...apaga o valor da MSG
                }
                ?>

                <FORM method="POST" action="proc_cad_pet.php">
                    <TABLE border='0' id='cadform'>
                        <tr>
                            <td>
                                <p>Nome do PET:
                            </td>
                            <td width='30'></td>
                            <td>
                                <p><INPUT type="text" id="cadplaceholder" class="form-control" name="nome" size="5" maxlength="20" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Tipo do PET:
                            </td>
                            <td width='30'></td>
                            <td>
                                <p><INPUT type="text" id="cadplaceholder" class="form-control" name="tipo" maxlength="8" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Idade do PET:
                            </td>
                            <td width='30'></td>
                            <td>
                                <p><INPUT type="text" id="cadplaceholder" class="form-control" name="idade" maxlength="2" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Sexo do PET:
                            </td>
                            <td width='30'></td>
                            <td>
                                <p><select name="sexo" id="cadplaceholder" class="form-control">
                                        <option value="Macho">Macho</option>
                                        <option value="Femea">Fêmea</option>
                                    </select>
                            </td>
                        </tr>
                        <tr>
                            <td>ID do Localizador:</td>
                            <td width='30'></td>
                            <td>
                                <p><INPUT type="text" id="cadplaceholder" class="form-control" name="id_gps" maxlength="5" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Dono:
                            </td>
                            <td width='30'></td>
                            <td>
                                <p><select name="nomedono" id="cadplaceholder" class="form-control">
                                    <?php
                                        $valores = "SELECT nome FROM dono ORDER BY nome ASC";
                                        $resultado = $conn->prepare($valores);
                                        $resultado->execute();
                                        while ($row_result = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='" . $row_result['nome'] . "'>". $row_result['nome'] ."</option><br>";
                                        }
                                    ?>
                                    </select>
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