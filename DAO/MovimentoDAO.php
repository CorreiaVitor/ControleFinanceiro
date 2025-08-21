<?php

require_once '../DAO/Conexao.php';
require_once '../DAO/UtilDAO.php';

class MovimentoDAO extends Conexao
{
    public function CadastrarDadosMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $obs)
    {
        if (empty($tipo) || empty($data) || empty($valor) || empty($categoria) || empty($empresa) || empty($conta)) {
            return 0;
        }else{
            $conexao = parent::retornarConexao();

            $comando_sql = 'INSERT INTO tb_movimento (tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    
            $sql = new PDOStatement();
    
            $sql = $conexao->prepare($comando_sql);
    
            $i = 1;
            $sql->bindValue($i++, $tipo);
            $sql->bindValue($i++, $data);
            $sql->bindValue($i++, $valor);
            $sql->bindValue($i++, $obs);
            $sql->bindValue($i++, $empresa);
            $sql->bindValue($i++, $conta);
            $sql->bindValue($i++, $categoria);
            $sql->bindValue($i++, UtilDAO::UsuarioLog());
    
            $conexao->beginTransaction();
    
            try {
                
                $sql->execute();
    
                //INSERÇÃO NA TB_MOVIMENTO
    
                if ($tipo == 1) {
                    $comando_sql = 'UPDATE tb_conta SET saldo_conta = saldo_conta + ? WHERE id_conta = ?';
                } elseif ($tipo == 2) {
                    $comando_sql = 'UPDATE tb_conta SET saldo_conta = saldo_conta - ? WHERE id_conta = ?';
                }
    
                $sql = $conexao->prepare($comando_sql);
    
                $sql->bindValue(1, $valor);
                $sql->bindValue(2, $conta);
    
                //ATUALIZAR O SALDO DA CONTA
                $sql->execute();
    
                $conexao->commit();
    
                return 1;
            } catch (Exception $ex) {
                $conexao->rollBack();
                echo $ex->getMessage();
                return -1;
            }            
        }
    }

    public function ExcluirDadosMovimento($id_movimento, $id_conta, $tipo, $valor)
    {
        if (empty($id_movimento) or empty($id_conta) or empty($tipo) or empty($valor)) {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'DELETE FROM tb_movimento WHERE id_movimento = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_movimento);

        $conexao->beginTransaction();

        try {

            //Deleta o registro
            $sql->execute();

            if ($tipo == 1) {
                $comando_sql = 'UPDATE tb_conta SET saldo_conta = saldo_conta - ? WHERE id_conta = ? ';
            } else if ($tipo == 2) {
                $comando_sql = 'UPDATE tb_conta SET saldo_conta = saldo_conta + ? WHERE id_conta = ?';
            }

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $id_conta);

            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            $conexao->rollBack();
            echo $ex->getMessage();
            return -1;
        }
    }

    public function FiltrarDadosMovimento($tipo, $dataI, $dataF)
    {

        if(empty($dataI) or empty($dataF))

        return 0;

        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT tb_movimento.id_movimento,
                               tb_movimento.tipo_movimento,
                               date_format(tb_movimento.data_movimento, "%d/%m/%Y") as data_movimento,
                               tb_movimento.valor_movimento,
                               tb_movimento.obs_movimento,
                               tb_empresa.nome_empresa,
                               tb_conta.id_conta,
                               tb_conta.banco_conta,
                               tb_conta.agencia_conta,
                               tb_conta.numero_conta,
                               tb_conta.saldo_conta,
                               tb_categoria.nome_categoria
                        FROM tb_movimento
                           INNER JOIN tb_empresa
                        ON tb_movimento.id_empresa = tb_empresa.id_empresa
                           INNER JOIN tb_conta
                        ON tb_movimento.id_conta = tb_conta.id_conta
                           INNER JOIN tb_categoria
                        ON tb_movimento.id_categoria = tb_categoria.id_categoria
                           WHERE tb_movimento.id_usuario = ?
                        AND tb_movimento.data_movimento BETWEEN ? AND ? ';

        if ($tipo != 0) {
            $comando_sql .= 'AND tipo_movimento = ?';
        }

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLog());
        $sql->bindValue(2, $dataI);
        $sql->bindValue(3, $dataF);

        if ($tipo != 0) {
            $sql->bindValue(4, $tipo);
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function MostrarUltimosLancamentos()
    {

        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT tb_movimento.id_movimento,
                               tb_movimento.tipo_movimento,
                               date_format(tb_movimento.data_movimento, "%d/%m/%Y") as data_movimento,
                               tb_movimento.valor_movimento,
                               tb_movimento.obs_movimento,
                               tb_empresa.nome_empresa,
                               tb_conta.id_conta,
                               tb_conta.banco_conta,
                               tb_conta.agencia_conta,
                               tb_conta.numero_conta,
                               tb_conta.saldo_conta,
                               tb_categoria.nome_categoria
                        FROM tb_movimento
                           INNER JOIN tb_empresa
                        ON tb_movimento.id_empresa = tb_empresa.id_empresa
                           INNER JOIN tb_conta
                        ON tb_movimento.id_conta = tb_conta.id_conta
                           INNER JOIN tb_categoria
                        ON tb_movimento.id_categoria = tb_categoria.id_categoria
                           WHERE tb_movimento.id_usuario = ?
                        ORDER BY tb_movimento.id_movimento DESC LIMIT 10';

    
        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLog());
       

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function TotalEntrada()
    {

        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT sum(valor_movimento) as total
                            FROM tb_movimento
                        WHERE tipo_movimento = 1 
                            AND id_usuario = ?';

        $sql = new PDOStatement;

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLog());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function TotalSaida()
    {

        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT sum(valor_movimento) as total
                            FROM tb_movimento
                        WHERE tipo_movimento = 2 
                            AND id_usuario = ?';

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLog());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
}
