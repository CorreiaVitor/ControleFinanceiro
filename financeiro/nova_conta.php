<?php

require_once '../DAO/ContaDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

if(isset($_POST['submit'])){
    $nomeBanco = $_POST['nomeBanco'];
    $agencia = $_POST['agencia'];
    $numConta = $_POST['numConta'];
    $saldo = $_POST['saldo'];

    $objDAO = new ContaDAO();
    
    $ret = $objDAO->CadastrarDadosConta($nomeBanco, $agencia, $numConta, $saldo);
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
                        <h2>Nova Conta</h2>
                        <h5>Aqui você podera Cadastrar todas as sua Contas Bancárias. </h5>
                    </div>
                </div>
                <hr />
                <div class="col-md-12">
                    <?php include_once '_msgErr.php'; ?>
                    <form action="nova_conta.php" method="post">
                        <div class="form-group" id="nomeB">
                            <label>Digite o nome do Banco...</label>
                            <input autocomplete="off" class="form-control" id="nomeBanco" name="nomeBanco" placeholder="Digite nome do Banco">
                        </div>
                        <div class="form-group" id="agen">
                            <label>Agência:</label>
                            <input autocomplete="off" type="number" class="form-control" id="agencia" name="agencia" placeholder="Digite Agência...">
                        </div>
                        <div class="form-group" id="num">
                            <label>Número da conta:</label>
                            <input autocomplete="off" type="number" class="form-control" id="numConta" name="numConta" placeholder="Digite Número da Conta">
                        </div>
                        <div class="form-group" id="saldos">
                            <label>Saldo:</label>
                            <input autocomplete="off" type="number" class="form-control" id="saldo" name="saldo" placeholder="Digite Saldo da conta...">
                        </div>
                        <button class="btn btn-success" name="submit" onclick="return ValidarNovaContaJS()">Gravar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>