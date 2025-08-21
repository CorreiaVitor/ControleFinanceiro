<?php

require_once '../DAO/Conexao.php';
require_once '../DAO/UtilDAO.php';

class CategoriaDAO extends Conexao
{
    public function CadastrarDadosCategoria($nome)
    {
        if(empty($nome)){
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'INSERT INTO tb_categoria (nome_categoria, id_usuario) VALUES (?, ?) ';

        $sql = new PDOStatement;

        $sql = $conexao->prepare($comando_sql);

        $i = 1;
        $sql->bindValue($i++, $nome);
        $sql->bindValue($i++, UtilDAO::UsuarioLog());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarDadosCategoria()
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT nome_categoria, 
                               id_categoria 
                            FROM tb_categoria 
                        WHERE id_usuario = ? 
                            ORDER BY nome_categoria ASC';

        $sql = new PDOStatement;


        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLog());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        //$sql->setFetchMode(PDO::FETCH_NUM);
        //$sql->setFetchMode(PDO::FETCH_OBJ);
        //$sql->setFetchMode(PDO::FETCH_BOTH);
        //$sql->setFetchMode(PDO::FETCH_CLASS, 'CategoriaDAO');


        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharDadosCategoria($id_categoria){

        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT id_categoria, nome_categoria, id_usuario  FROM tb_categoria WHERE id_categoria = ? AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_categoria);
        $sql->bindValue(2, UtilDAO::UsuarioLog());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();
        
        return $sql->fetchAll();
        
    }

    public function AlterarDadosCategoria($nome, $id_categoria){

        if(empty($nome)){
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'UPDATE tb_categoria SET nome_categoria = ? WHERE id_categoria = ? AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $id_categoria);        
        $sql->bindValue(3, UtilDAO::UsuarioLog());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $ex->getMessage();
            return -1;
        }

    }

    public function ExcluirDadosCategoria($id_categoria) 
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'DELETE FROM tb_categoria WHERE id_categoria = ? AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_categoria);
        $sql->bindValue(2, UtilDAO::UsuarioLog());

        try {
           $sql->execute();
           return 1;
        } catch (Exception $ex) {
            $ex->getMessage();
            return -4;
        }
    }
}

?> 