<?php

require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objDAO = new CategoriaDAO;

if (($_GET['cod']) && is_numeric($_GET['cod'])) {

    $id_categoria = $_GET['cod'];

    $dados = $objDAO->DetalharDadosCategoria($id_categoria);

    if (count($dados) == 0) {
        header("location: consultar_categoria.php");
    }
} else if (isset($_POST['submit'])) {

    $nomeCategoria = $_POST['nomeCategoria'];
    $id_categoria = $_POST['id_categoria'];

    $ret = $objDAO->AlterarDadosCategoria($nomeCategoria, $id_categoria);

    header('location: consultar_categoria.php?ret=' . $ret);
} else if (isset($_POST['btn_delete'])) {

    $id_categoria = $_POST['id_categoria'];

    $ret = $objDAO->ExcluirDadosCategoria($id_categoria);

    header('location: consultar_categoria.php?ret=' . $ret);
} else {
    header("location: consultar_categoria.php");
    exit;
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
                        <h2>Alterar e excluir categoria </h2>
                        <h5>Aqui você irá alterar a categoria selecionada.</h5>
                    </div>
                </div>
                <hr />
                <div class="col-md-12">
                    <form action="alterar_categoria.php" method="post">
                        <div class="form-group" id="nomeC">
                            <label>Nome da Categoria:</label>
                            <input autocomplete="off"  class="form-control" name="nomeCategoria" value="<?= $dados[0]['nome_categoria'] ?>" id="nomeCategoria" placeholder="Digite sua Categoria...">
                        </div>
                        <button class="btn btn-success" name="submit" onclick="return ValidarAlterarCategoriaJS()">Salvar</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Excluir</button>
                        
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel" style="color: red;">Confirmação de exclusão</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input autocomplete="off" type="hidden" value="<?= $dados[0]['id_categoria'] ?>" name="id_categoria">
                                    <span>Você deseja excluir a categoria: </span><strong><?= $dados[0]['nome_categoria'] ?>?</strong>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <button class="btn btn-success" name="btn_delete" >Confirmar</button>
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