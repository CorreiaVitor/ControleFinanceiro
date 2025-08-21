<?php

require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$tipo = '';

$objDAO = new MovimentoDAO();

if (isset($_POST['submit'])) {

    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $dataF = $_POST['dataF'];


    $dados = $objDAO->FiltrarDadosMovimento($tipo, $data, $dataF);

    if (isset($dados) && $dados != '') {
        $msgOK = '<div class="alert alert-danger">
        Consulta realizada com sucesso!
      </div>';
    }
} elseif (isset($_POST['btn_excluir'])) {

    $idMov = $_POST['idMov'];
    $idConta = $_POST['idConta'];
    $tipoM = $_POST['tipoM'];
    $valor = $_POST['valor'];

    $ret = $objDAO->ExcluirDadosMovimento($idMov, $idConta, $tipoM, $valor);
}

// echo '<pre>';
// var_dump($valor);
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
                        <h2>Consultar Movimentos</h2>
                        <h5>Aqui você irá consultar todos os movimentos financeiros de ENTRADA e SAIDA.</h5>
                    </div>
                </div> 
                <hr />
                <form action="consultar_movimento.php" method="post">
                    <div class="col-md-12">
                        <div class="form-group" id="tipoM">
                            <label>Tipo do movimento:</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="0" <?= $tipo == '0' ? 'selected' : '' ?>>Todos Movimentos</option>
                                <option value="1" <?= $tipo == '1' ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $tipo == '2' ? 'selected' : '' ?>>Saida</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="dataI">
                            <label>Data incial:</label>
                            <input type="date" class="form-control" name="data" id="data" value="<?= $data ? $data : '' ?>" placeholder="Coloque a data do movimento">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="dateF">
                            <label>Data final:</label>
                            <input type="date" class="form-control" name="dataF" id="dataF" value="<?= $dataF ? $dataF : '' ?>" placeholder="Coloque a data do movimeto">
                        </div>

                    </div>
                    <div style="text-align: center;">
                        <button class="btn btn-primary" name="submit" onclick="return ValidarConsultarMovimentoJS()">Pesquisar</button>
                    </div>
                </form>
                <hr />
                <?php if (isset($dados) ? $dados : null) { ?>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span>Aqui você pode consultar todos os movimentos realizados ou se desejar excluir.</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-body">
                                        <div class="table responsive">
                                            <table class="table table-striped table-bordered table-hover" id="datatables-example">
                                                <Thead>
                                                    <tr>
                                                        <th>Data</th>
                                                        <th>Tipo</th>
                                                        <th>Categoria</th>
                                                        <th>Empresa</th>
                                                        <th>Conta</th>
                                                        <th>Valor</th>
                                                        <th>Observação</th>
                                                        <th>Ação</th>
                                                    </tr>
                                                </Thead>
                                                <tbody>
                                                    <?php
                                                    $total = 0;
                                                    for ($i = 0; $i < count($dados); $i++) {
                                                        if ($dados[$i]['tipo_movimento'] == '1') {
                                                            $total = $total + ($dados[$i]['valor_movimento']);
                                                        } else {
                                                            $total = $total - ($dados[$i]['valor_movimento']);
                                                        } ?>
                                                        <tr class="odd gradeX">
                                                            <td><?= $dados[$i]['data_movimento'] ?></td>
                                                            <td><?= $dados[$i]['tipo_movimento'] == '1' ? 'Entrada' : 'Saída' ?></td>
                                                            <td><?= $dados[$i]['nome_categoria'] ?> </td>
                                                            <td><?= $dados[$i]['nome_empresa'] ?> </td>
                                                            <td><?= $dados[$i]['banco_conta'] ?> /Ag. <?= $dados[$i]['agencia_conta'] ?> /N.º Conta <?= $dados[$i]['numero_conta'] ?> /Saldo <?= number_format($dados[$i]['saldo_conta'], 2, ',', '.') ?> </td>
                                                            <td>R$<?= number_format($dados[$i]['valor_movimento'], 2, ',', '.') ?></td>
                                                            <td><?= $dados[$i]['obs_movimento'] ?></td>
                                                            <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-excluir<?= $i ?>">Excluir</button></td>

                                                            <form action="consultar_movimento.php" method="post">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="idMov" value="<?= $dados[$i]['id_movimento'] ?>">
                                                                    <input type="hidden" name="idConta" value="<?= $dados[$i]['id_conta'] ?>">
                                                                    <input type="hidden" name="tipoM" value="<?= $dados[$i]['tipo_movimento'] ?>">
                                                                    <input type="hidden" name="valor" value="<?= $dados[$i]['valor_movimento'] ?>">
                                                                </div>
                                                                <div class="modal fade" id="modal-excluir<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5 style="text-align: center; color: red;"><strong>Deseja realmente excluir esse movimento?</strong></h5>
                                                                                <hr>
                                                                                <div class="form-group">
                                                                                    <b>Data: </b><span><?= $dados[$i]['data_movimento'] ?></span>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <b>Tipo: </b><span><?= $dados[$i]['tipo_movimento'] == '1' ? 'Entrada' : 'Saída' ?></span>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <b>Categoria: </b><span><?= $dados[$i]['nome_categoria'] ?></span>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <b>Empresa: </b><span><?= $dados[$i]['nome_empresa'] ?></span>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <b>Conta: </b><span><?= $dados[$i]['banco_conta'] ?> / Ag. <?= $dados[$i]['agencia_conta'] ?> / N.º Conta <?= $dados[$i]['numero_conta'] ?> / Saldo <?= number_format($dados[$i]['saldo_conta'], 2, ',', '.') ?></span>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <b>Valor: </b><span><?= $dados[$i]['valor_movimento'] ?></span>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <b>Observaçoes: </b><span><?= $dados[$i]['obs_movimento'] ?></span>
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                                    <button class="btn btn-success" name="btn_excluir">Confirmar</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </tr>
                                                    <?php  } ?>
                                                </tbody>
                                            </table>
                                            <div style="text-align: center;">
                                                <strong>Total: </strong>
                                                <strong style="color: <?= $total < 0 ? 'red' : 'green' ?>;">R$ <?= number_format($total, 2, ',', '.') ?></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>