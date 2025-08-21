<?php

require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objDAO = new CategoriaDAO;

if(isset($_POST['submit'])){
    $nomeCategoria = $_POST['nomeCategoria'];

    $ret = $objDAO->CadastrarDadosCategoria($nomeCategoria);

    
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
                        <h2>Nova Categoria</h2>
                        <h5>Aqui você podera cadastrar todas as sua Categorias!</h5>
                    </div>
                </div>
                <hr />
                <form action="nova_categoria.php" method="post">
                    <div class="col-md-12">
                        <div class="form-group" id="nomeC">
                            <label>Nome da Categoria:</label>
                            <input autocomplete="off" class="form-control" name="nomeCategoria" id="nomeCategoria" placeholder="Digite o nome da categoria. Exemplo:Conta de Internet...">
                        </div>
                        <button class="btn btn-success" name="submit" onclick="return ValidarNovaCategoriaJS()">Gravar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>