<?php

require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/ContaDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objEmpresa = new EmpresaDAO;
$objCategoria = new CategoriaDAO;
$objConta = new ContaDAO;

if (isset($_POST['submit'])) {

    $tipo =  $_POST['tipo'];
    $data = $_POST['data'];
    $valor =  $_POST['valor'];
    $categoria =  $_POST['categoria'];
    $empresa =  $_POST['empresa'];
    $conta =  $_POST['conta'];
    $obs =  $_POST['obs'];

    $objDAO = new MovimentoDAO;
    $ret = $objDAO->CadastrarDadosMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $obs);
}

$empresa = $objEmpresa->ConsultarDadosEmpresa();
$categoria = $objCategoria->ConsultarDadosCategoria();
$conta = $objConta->ConsultarDadosContas();


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php'; ?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msgErr.php'; ?>
                        <h2>Realizar Movimento</h2>
                        <h5>Nessa página, você poderá realizar seus movimentos de entrada ou saída</h5>
                    </div>
                </div>
                <!-- /ROW -->
                <hr />
                <form action="realizar_movimento.php" method="post">
                    <div class="col-md-6">
                        <div class="form-group" id="tipoM">
                            <label>Tipo do Movimento:</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Selecione</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saida</option>
                            </select>
                        </div>
                        <div class="form-group" id="dataM">
                            <label>Data Movimento:</label>
                            <input autocomplete="off" type="date" class="form-control" name="data" id="data">
                        </div>
                        <div class=" form-group" id="value">
                            <label>Valor:</label>
                            <input autocomplete="off" type="text" class="form-control" placeholder="Digite o valor do movimento" name="valor" id="valor">
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group" id="categorias">
                            <label>Categoria:</label>
                            <select class="form-control" name="categoria" id="categoria">
                                <option value="">Selecione</option>
                                <?php foreach ($categoria as $dados) { ?>
                                    <option value="<?= $dados['id_categoria'] ?>"><?= $dados['nome_categoria'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" id="empresas">
                            <label>Empresa:</label>
                            <select class="form-control" name="empresa" id="empresa">
                                <option value="">Selecione</option>
                                <?php foreach ($empresa as $edados) { ?>
                                    <option value="<?= $edados['id_empresa'] ?>"><?= $edados['nome_empresa'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" id="contas">
                            <label>Conta:</label>
                            <select class="form-control" name="conta" id="conta">
                                <option value="">Selecione</option>
                                <?php foreach ($conta as $cdados) { ?>
                                    <option value="<?= $cdados['id_conta'] ?>"><?= 'Banco: ' . $cdados['banco_conta'] . ' / ' . 'Agência: ' . $cdados['agencia_conta'] . ' / ' . 'número conta: ' . $cdados['numero_conta'] . ' / ' . 'saldo: ' . $cdados['saldo_conta'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observação(opcional):</label>
                            <textarea class="form-control" rows="4" placeholder="Registre uma observação aqui..." name="obs" id="obs" value=""></textarea>
                        </div>
                        <button type="submit" class="btn btn-success" name="submit" onclick="return ValidarRealizarMovimentoJS() ">Realizar Movimento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>