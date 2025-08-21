<?php

require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/UtilDAO.php';

UtilDAO::VerificarLogado();

$objDAO = new CategoriaDAO;

$dados = $objDAO->ConsultarDadosCategoria();

// echo '<pre>';
// var_dump($dados);
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
                        <h2>Consultar categorias cadastradas</h2>
                        <h5>Aqui você irá consultar todas as suas Categorias cadastradas .</h5>
                    </div>
                </div>
                <hr />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <Span>Categorias Cadastradas. Caso deseje alterar, clique no Botão ALTERAR.</span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-body">
                                <div class="tabel-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome da Categoria</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <?php foreach($dados as $itens) : ?>
                                            <tbody>
                                                <tr>
                                                    <td><?= $itens['nome_categoria'] ?></td>
                                                    <td><a href="alterar_categoria.php?cod=<?=$itens['id_categoria']?>" class="btn btn-warning">alterar</a></td>
                                                </tr>
                                            </tbody>
                                        <?php endforeach ?>
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