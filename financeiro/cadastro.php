<?php

require_once '../DAO/UsuarioDAO.php';

$objDAO = new UsuarioDAO;

if(isset($_POST['submit'])){

            
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$rsenha = $_POST['rsenha'];

$ret = $objDAO->CadastrarDadosUsuario($nome, $email, $senha, $rsenha);

}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include_once '_head.php'; ?>

<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msgErr.php'; ?>
                <h2>Sistema Financeiro:Cadastro</h2>
                <h5>(Registre seu Cadastro aqui)</h5>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>Novo usuario?Cadastre-se agora</span>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="cadastro.php" method="post">
                       
                            <div class="form-group input-group" id="nomes">
                                <span class="input-group-addon"><em class="fa fa-circle-o-notch"></em></span>
                                <input autocomplete="off" type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu nome" />
                            </div>
                            <div class="form-group input-group" id="emails">
                                <span class="input-group-addon">@</span>
                                <input autocomplete="off" type="email" class="form-control" name="email" id="email" placeholder="Digite seu E-mail..." />
                            </div>
                            <div class="form-group input-group" id="senhas">
                                <span class="input-group-addon"><em class="fa fa-lock"></em></span>
                                <input autocomplete="off" type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua Senha (Mínimo 6 caracteristica  )" />
                            </div>
                            <div class="form-group input-group" id="password">
                                <span class="input-group-addon"><em class="fa fa-lock"></em></span>
                                <input autocomplete="off" type="password" class="form-control" name="rsenha" id="rsenha" placeholder="Digite novamente sua senha" />
                            </div>
                            <button class="btn btn-success" name="submit" onclick="return ValidarCadastroJS()">Cadastro</button>
                            <span>Ja possui cadastro?</span><a href="login.php">Clique aqui!</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>