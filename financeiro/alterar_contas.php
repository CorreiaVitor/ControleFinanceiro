<?php

require_once '../DAO/ContaDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objDAO = new ContaDAO;

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $id_conta = $_GET['cod'];

    $dados = $objDAO->DetarlharDadosConta($id_conta);


    if (count($dados) == 0)
        header("location: consultar_contas.php");
} elseif (isset($_POST['btn_alterar'])) {


    $nomeBanco = $_POST['nomeBanco'];
    $agencia = $_POST['agencia'];
    $numConta = $_POST['numConta'];
    $saldo = $_POST['saldo'];
    $id_conta = $_POST['id_conta'];


    $ret = $objDAO->AlterarDadosConta($id_conta, $nomeBanco, $agencia, $numConta, $saldo);

    header("location: consultar_contas.php?ret=$ret");

} elseif (isset($_POST['btn_excluir'])) {

   
    $id_conta = $_POST['id_conta'];

    $ret = $objDAO->DeletarDadosConta($id_conta);

    header("location: consultar_contas.php?ret=$ret");

} else {
    header("location: consultar_contas.php");
}

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
                        <h2>Alterar Contas</h2>
                        <h5>Aqui você podera ALTERAR ou EXCLUIR suas Contas Bancárias!</h5>
                    </div>
                </div>
                <hr />
                <div class="col-md-12">
                    <form action="alterar_contas.php" method="post">
                        <div class="form-group" id="nomeB">
                            <label>Nome do Banco:</label>
                            <input autocomplete="off" class="form-control" id="nomeBanco" name="nomeBanco" value="<?= $dados[0]['banco_conta'] ?>" placeholder="Digite nome do Banco...">
                        </div>
                        <div class="form-group" id="agen">
                            <label>Agência:</label>
                            <input autocomplete="off" class="form-control" id="agencia" name="agencia" value="<?= $dados[0]['agencia_conta'] ?>" placeholder="Digite Agência...">
                        </div>
                        <div class="form-group" id="num">
                            <label>Número da conta:</label>
                            <input autocomplete="off" class="form-control" id="numConta" name="numConta" value="<?= $dados[0]['numero_conta'] ?>" placeholder="Digite Número da Conta">
                        </div>
                        <div class="form-group" id="saldos">
                            <label>Saldo:</label>
                            <input autocomplete="off" class="form-control" id="saldo" name="saldo" value="<?= $dados[0]['saldo_conta'] ?>" placeholder="Digite Saldo da conta...">
                        </div>

                        <button class="btn btn-success" name="btn_alterar" onclick="return ValidarNovaContaJS()">Salvar</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Excluir</button>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirma Exclusão</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input autocomplete="off" type="hidden" name="id_conta" value="<?= $dados[0]["id_conta"] ?>">
                                        <h4 style="text-align: center;">Deseja realmente excluir essa conta bancária?</h4>
                                        <hr>
                                        <div class="form-group"><span>Nome do Banco: </span><strong><?= $dados[0]['banco_conta'] ?></strong></div>
                                        <div class="form-group"><span>Âgencia: </span><strong><?= $dados[0]['agencia_conta'] ?></strong></div>
                                        <div class="form-group"><span>Numero da conta: </span><strong><?= $dados[0]['numero_conta'] ?></strong></div>
                                        <div class="form-group"><span>Saldo: </span><strong><?= $dados[0]['saldo_conta'] ?></strong></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                        <button class="btn btn-danger" name="btn_excluir">Confirmar</button>
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