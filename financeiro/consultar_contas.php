<?php

require_once '../DAO/ContaDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objDAO = new ContaDAO;

$dados = $objDAO->ConsultarDadosContas();

// UtilDAO::Var_dump($dados);

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
                        <h2>Consultar Contas</h2>
                        <h5>Consulte todas as suas Contas Bancárias aqui!</h5>
                    </div>
                </div>
                <hr />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>Contas Bancárias Cadastradas. Caso deseja alterar, clique no Botão ALTERAR</span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-body">
                                <div class="table responsive">
                                    <table class="table table-striped table-bordered table-hover" id="datatables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome do Banco</th>
                                                <th>Agência</th>
                                                <th>Número da conta</th>
                                                <th>Saldo</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($dados as $contas) { ?>
                                                <tr>
                                                    <td><?= $contas['banco_conta'] ?></td>
                                                    <td><?= $contas['agencia_conta'] ?></td>
                                                    <td><?= $contas['numero_conta'] ?></td>
                                                    <td><?= number_format($contas['saldo_conta'], 2, ',', '.') ?></td>
                                                    <td><a href="alterar_contas.php?cod=<?= $contas['id_conta'] ?>" class="btn btn-warning">Alterar</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>