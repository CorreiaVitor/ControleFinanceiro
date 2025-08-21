<?php

require_once '../DAO/UsuarioDAO.php';

if(isset($_POST['submit'])){

    $nome = trim($_POST['email']);
    $senha = trim($_POST['password']);

    $objDAO = new UsuarioDAO();

    $ret = $objDAO->ValidarLogin($nome, $senha);

}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    
<?php include_once '_head.php'; ?>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msgErr.php'; ?>
                <h2>Controle financeiro</h2>
                <h5>(Faça seu Login de Acesso)</h5>
                <br />
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Digite os dados do seu login</strong>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="login.php">
                            <div class="form-group input-group" id="emails">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input autocomplete="off" type="text" class="form-control" name="email" id="email" placeholder="Seu E-mail..." />
                            </div>
                            <div class="form-group input-group" id="senha">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input autocomplete="off" type="password" name="password" id="password" class="form-control" placeholder="Sua Senha..." />
                            </div>
                            <div style="text-align: center;">
                                <button name="submit" class="btn btn-primary" onclick="return ValidarLoginJS()">Acessar</button>
                            </div>
                            <hr />
                            <span>Não é cadastrado?</span><a href="cadastro.php">Clique aqui </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>