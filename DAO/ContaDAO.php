<?php

require_once 'Conexao.php';
include_once 'UtilDAO.php';

class ContaDAO extends Conexao
{
    private $conn;

    public function __construct()
    {
        $this->conn = parent::retornarConexao();
    }

    public function CadastrarDadosConta($nome_B, $agencia, $conta_N, $saldo)
    {
        if (empty($nome_B) or empty($agencia) or empty($conta_N) or empty($saldo)) {
            return 0;
        }

        $comando_sql = 'INSERT INTO tb_conta (banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario) VALUES (?, ?, ?, ?, ?) ';

        $sql = $this->conn->prepare($comando_sql);

        $i = 1;
        $sql->bindValue($i++, $nome_B);
        $sql->bindValue($i++, $agencia);
        $sql->bindValue($i++, $conta_N);
        $sql->bindValue($i++, $saldo);
        $sql->bindValue($i++, UtilDAO::UsuarioLog());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarDadosContas()
    {
        $comando_sql = 'SELECT id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario FROM tb_conta WHERE id_usuario = ? ';

        $sql = $this->conn->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLog());

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function DetarlharDadosConta($id_empresa)
    {
        $comando_sql = 'SELECT id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario FROM tb_conta WHERE id_conta = ? AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $this->conn->prepare($comando_sql);

        $sql->bindValue(1, $id_empresa);
        $sql->bindValue(2, UtilDAO::UsuarioLog());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarDadosConta($id_conta, $nomeBanco, $agencia, $numConta, $saldo)
    {
        if (empty($nomeBanco) or empty($agencia) or empty($numConta) or empty($saldo)) {
            return 0;
        }

        $comando_sql = 'UPDATE tb_conta 
                            SET banco_conta = ?, agencia_conta = ?, numero_conta = ?, saldo_conta = ? 
                        WHERE id_conta = ? AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $this->conn->prepare($comando_sql);

        $i = 1;
        $sql->bindValue($i++, $nomeBanco);
        $sql->bindValue($i++, $agencia);
        $sql->bindValue($i++, $numConta);
        $sql->bindValue($i++, $saldo);
        $sql->bindValue($i++, $id_conta);
        $sql->bindValue($i++, UtilDAO::UsuarioLog());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function DeletarDadosConta($id_conta)
    {
        
        $comando_sql = 'DELETE FROM tb_conta WHERE id_conta = ? AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $this->conn->prepare($comando_sql);

        $sql->bindValue(1, $id_conta);
        $sql->bindValue(2, UtilDAO::UsuarioLog());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -4;
        }
    }
}
