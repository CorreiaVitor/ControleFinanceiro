<?php

    require_once '../DAO/Conexao.php';
    require_once '../DAO/UtilDAO.php';

    class EmpresaDAO extends Conexao
    {
        public function CadastrarDadosEmpresa($nome, $phone, $ender)
        {
            if(empty($nome)){
                return 0;
            }

            $conexao = parent::retornarConexao();

            $comando_sql = 'INSERT INTO tb_empresa 
                                    (nome_empresa, telefone_empresa, endereco_empresa, id_usuario) 
                            VALUES (?, ?, ?, ?) ';

            $sql = new PDOStatement();
            
            $sql = $conexao->prepare($comando_sql);

            $i = 1;
            $sql->bindValue($i++, $nome);
            $sql->bindValue($i++, $phone);
            $sql->bindValue($i++, $ender);
            $sql->bindValue($i++, UtilDAO::UsuarioLog());

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                $ex->getMessage();
                return -1;
            }
        } 

        public function ConsultarDadosEmpresa(){
            
            $conexao = parent::retornarConexao();

            $comando_sql = 'SELECT id_empresa, nome_empresa, telefone_empresa, endereco_empresa, id_usuario FROM tb_empresa WHERE id_usuario = ?';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::UsuarioLog());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            return $sql->fetchAll();

        }

        public function DetalharDadosEmpresa($id_empresa){

            $conexao = parent::retornarConexao();

            $comando_sql = 'SELECT id_empresa, nome_empresa, telefone_empresa, endereco_empresa, id_usuario FROM tb_empresa WHERE id_empresa = ? AND id_usuario = ?';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $id_empresa);
            $sql->bindValue(2, UtilDAO::UsuarioLog());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            return $sql->fetchAll();

        }

        public function AlterarDadosEmpresa($nome, $phone, $ender, $id_empresa)
        {

            $conexao = parent::retornarConexao();

            $comando_sql = 'UPDATE tb_empresa 
                                SET nome_empresa = ?, 
                                    telefone_empresa = ?, 
                                    endereco_empresa = ? 
                                WHERE id_empresa = ? AND id_usuario = ? ';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $i = 1;
            $sql->bindValue($i++, $nome);
            $sql->bindValue($i++, $phone);
            $sql->bindValue($i++, $ender);
            $sql->bindValue($i++, $id_empresa);
            $sql->bindValue($i++, UtilDAO::UsuarioLog());

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                $ex->getMessage();
                return -1;
            }

        } 

        public function ExcluirDadosEmpresa($id_empresa){

            $conexao = parent::retornarConexao();

            $comando_sql = 'DELETE FROM tb_empresa WHERE id_empresa = ? AND id_usuario = ?';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $i = 1;
            $sql->bindValue($i++, $id_empresa);
            $sql->bindValue($i++, UtilDAO::UsuarioLog());

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -4;
            }

        }
    }

    

?>