<?php

require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objMov = new MovimentoDAO();

$entrada = $objMov->TotalEntrada();
$saida = $objMov->TotalSaida();
$dados = $objMov->MostrarUltimosLancamentos();

// echo '<pre>';
// var_dump($saida);
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
                        <h2>Pagina Inicial</h2>
                        <h5>Aqui você acompanha todos os seus números de uma forma geral</h5>
                    </div>
                </div>
                <hr />
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>R$ <?= number_format($entrada[0]['total'], 2, '.', ',') ?></h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                            TOTAL DE ENTRADA
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>R$ <?= number_format($saida[0]['total'], 2, '.', ',') ?> </h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            TOTAL DE SAIDA
                        </div>
                    </div>
                </div>
                <div class="col-md-12">

                    <?php if (count($dados) > 0) { ?>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span>Últimos 10 lançamentos do seus movimentos.</span>
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
                    <?php } else { ?>
                        <div style="text-align: center">
                            <div class="alert alert-info">
                                Não existe nenhum movimento para ser exibido
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>