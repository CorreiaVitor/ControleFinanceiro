<?php

require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objDAO = new EmpresaDAO();

$dados = $objDAO->ConsultarDadosEmpresa();


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
                        <h2>Consultar Empresas</h2>
                        <h5>Consulte todas as suas Empresas aqui!</h5>
                    </div>
                </div>
                <hr />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>Empresas Cadastradas. Caso desejar, cliaque no Botão Alterar</span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-body">
                                <div class="table responsive">
                                    <table class="table table-striped table-bordered table-hover" id="datatables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome da Empresa</th>
                                                <th>Telefone/WhatsApp</th>
                                                <th>Endereço</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($dados); $i++) { ?>
                                                <tr>
                                                    <td><?= $dados[$i]['nome_empresa'] ?></td>
                                                    <td><?= $dados[$i]['telefone_empresa'] ?></td>
                                                    <td><?= $dados[$i]['endereco_empresa'] ?></td>
                                                    <td><a href="alterar_empresa.php?cod=<?= $dados[$i]['id_empresa'] ?>" class="btn btn-warning">Alterar</a></td>
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
    </div>
</body>

</html>