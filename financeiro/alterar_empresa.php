<?php

require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objDAO = new EmpresaDAO;

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $id_empresa = $_GET['cod'];

    $dados = $objDAO->DetalharDadosEmpresa($id_empresa);

    if (count($dados) == 0) {
        header("location: consultar_empresa.php");
    }
} elseif (isset($_POST['submit'])) {

    $nome = trim($_POST['nomeEmpresa']);
    $telefone = trim($_POST['telefone']);
    $ender = trim($_POST['endereco']);
    $id_empresa = trim($_POST['id_empresa']);

    $ret = $objDAO->AlterarDadosEmpresa($nome, $telefone, $ender, $id_empresa);

    header("location: consultar_empresa.php?ret=$ret");
} elseif (isset($_POST['btn_excluir'])) {

    $id_empresa = $_POST['id_empresa'];

    $ret = $objDAO->ExcluirDadosEmpresa($id_empresa);

    header("location: consultar_empresa.php?ret=$ret");
} else {
    header("location: consultar_empresa.php");
}

$ocultar = true;


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php'; ?>

<body>
    <?php include_once '_topo.php'; ?>
    <?php include_once '_menu.php'; ?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msgErr.php'; ?>
                        <h2>Alterar Empresa</h2>
                        <h5>Aqui você pode ALTERAR ou EXCLUIR sua Empresas!</h5>
                    </div>
                </div>
                <hr />
                <div class="col-md-12">
                    <form action="alterar_empresa.php" method="post">
                        <div class="form-group" id="nomes">
                            <label>Nome da Empresa:</label>
                            <input autocomplete="off" class="form-control" name="nomeEmpresa" id="nomeEmpresa" value="<?= $dados[0]['nome_empresa'] ?>" placeholder="Digite Nome da Empresa. Exemplo: Casas Bahia...">
                        </div>
                        <div class="form-group" id="phone">
                            <label>Telfone/WhatsApp:</label>
                            <input autocomplete="off" type="number" class="form-control" name="telefone" id="telefone" value="<?= $dados[0]['telefone_empresa'] ?>" placeholder="Digite Telefone/WhatsApp da Empresa(Opcional!).">
                        </div>
                        <div class="form-group" id="ender">
                            <label>Endereço:</label>
                            <input autocomplete="off" class="form-control" name="endereco" id="endereco" value="<?= $dados[0]['endereco_empresa'] ?>" placeholder="Digite Endereço da Empresa(opcional)">
                        </div>
                        <button class="btn btn-success" name="submit" onclick="return ValidarAlterarEmpresaJS()">Salvar</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Excluir</button>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input autocomplete="off" type="hidden" name="id_empresa" value="<?= $dados[0]['id_empresa'] ?>">
                                        <h4 style="text-align: center;">Deseja realmente excluir essa conta bancária?</h4>
                                        <hr>
                                        <div class="form-group">
                                            <span>Nome da Empresa: </span>
                                            <strong><?= $dados[0]['nome_empresa'] ?></strong>
                                        </div>
                                        <div class="form-group">
                                            <?php if ($dados[0]['telefone_empresa'] ? $dados : '') { ?>
                                                <span>Telefone\WhatsApp: </span>
                                                <strong><?= $dados[0]['telefone_empresa'] ?></strong>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <?php if ($dados[0]['endereco_empresa']) { ?>
                                                <span>Endereço: </span>
                                                <strong><?= $dados[0]['endereco_empresa'] ?></strong>
                                            <?php } ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-success" name="btn_excluir">Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>