<?php

require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objDAO = new EmpresaDAO;

if (isset($_POST['submit'])) {

    $nomeEmpresa = $_POST['nomeEmpresa'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $ret = $objDAO->CadastrarDadosEmpresa($nomeEmpresa, $telefone, $endereco);
}

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
                        <h2>Nova Empresa</h2>
                        <h5>Aqui você podera cadastrar todos os nomes das Empresas.</h5>
                    </div>
                </div>
                <hr />
                <div class="col-md-12">
                    <form action="nova_empresa.php" method="post">
                        <div class="form-group" id="nomes">
                            <label>Nome da Empresa:</label>
                            <input autocomplete="off" class="form-control" name="nomeEmpresa" id="nomeEmpresa" placeholder="Digite Nome da Empresa. Exemplo: Casas Bahia...">
                        </div>
                        <div class="form-group" id="phone">
                            <label>Telefone/WhatsApp:</label>
                            <input autocomplete="off" type="number" class="form-control" name="telefone" id="telefone" placeholder="Digite Telefone/WhatsApp da Empresa(Opcional!).">
                        </div>
                        <div class="form-group" id="ender">
                            <label>Endereço:</label>
                            <input autocomplete="off" class="form-control" name="endereco" id="endereco" placeholder="Digite Endereço da Empresa(opcional)">
                        </div>
                        <button class="btn btn-success" name="submit" onclick="return ValidarNovaEmpresaJS()">Gravar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>