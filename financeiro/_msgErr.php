<?php

if (isset($_GET['ret'])) {
  $ret = $_GET['ret'];
}

if (isset($ret)) {

  switch ($ret) {
    case 0:
      echo '<div class="alert alert-warning">
              Por favor, preencher todos os campos obrigatórios!
            </div>';
      break;
    case 1:
      echo '<div class="alert alert-success">
              Ação realizada com sucesso
            </div>';
      break;
    case -1:
      echo '<div class="alert alert-danger">
              Ocorreu um erro, tente novamente mais tarde
            </div>';
      break;
    case -2:
      echo '<div class="alert alert-warning">
              A senha deverá conter no mínimo 6 caracteres
            </div>';
      break;
    case -3:
      echo '<div class="alert alert-warning">
              A senha e o repetir senha não conferem
            </div>';
      break;
    case -4:
      echo '<div class="alert alert-warning">
              O registro não poderá ser excluido, pois está em uso!
            </div>';
      break;
    case -5:
      echo '<div class="alert alert-danger">
              E-mail já cadastrado. coloque outro e-mail!
            </div>';
      break;
    case -6:
      echo '<div class="alert alert-danger">
              Usuário não encontrado!
            </div>';
      break;
  }
}

if (isset($dados)) {
  switch ($dados) {
    case 0:
      echo '<div class="alert alert-danger">
      Preencher todos os campos!
      </div>';
    break;
  }
}
