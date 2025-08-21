<?php

require_once '../DAO/UsuarioDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objDAO = new UsuarioDAO;

if (isset($_POST['submit'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $ret = $objDAO->GravarDadosUsuario($nome, $email);
}

$dados = $objDAO->CarregarMeusDados();

// echo '<pre>';
// var_dump($dados);
// echo '</pre>';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include_once '_head.php' ?>

<body>
    <?php include_once '_topo.php' ?>
    <?php include_once '_menu.php' ?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msgErr.php'; ?>
                        <h2>Meus Dados </h2>
                        <h5>Seja Bem vindo <?= $dados[0]['nome_usuario'] ?>, aqui você pode colocar todos os seus Dados.</h5>
                    </div>
                </div>
                <hr />
                <form id="formID" role="form" action="meus_dados.php" method="post">
                    <div class="form-group" id="nomes">
                        <label>Nome:</label>
                        <input autocomplete="off" class="form-control" name="nome" id="nome" value="<?= $dados[0]['nome_usuario'] ?>" placeholder="Digite seu Nome...">
                    </div>
                    <div class="form-group" id="emails">
                        <label>E-mail:</label>
                        <input autocomplete="off" class="form-control" name="email" id="email" value="<?= $dados[0]['email_usuario'] ?>" placeholder="Digite seu E-mail...">
                    </div>
                    <button class="btn btn-success" name="submit" onclick="return ValidarMeusDadosJS()">Gravar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>