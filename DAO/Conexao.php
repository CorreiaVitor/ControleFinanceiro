<?php
//self comando que reaproveita comandos da mesma classe
//poo classe imbutida propria do php para interagir com todos os SGBDs (softwares de gerenciamento de SQL)
// Configurações do site
define('HOST', 'db'); //IP
define('USER', 'root'); //usuario
define('PASS', 'root'); //Senha
define('DB', 'db_financeiro'); //Banco
/**
 * Conexao.class TIPO [Conexão]
 * Descricao: Estabelece conexões com o banco usando SingleTon
 * @copyright (c) year, WMBarros
 */

class Conexao 
{

    /** @var PDO */
    private static $Connect;


    //funcao estatica nao cria objeto na memoria, funciona de forma direta
    //quando uma estrutura de funcao é padra, nao sofre alteracoes, podemos utilizar a funcao estatica
    private static function Conectar()
    {
        try {
            //Verifica se a conexão não existe
            if (self::$Connect == null) :
                $dsn = 'mysql:host=' . HOST . ';dbname=' . DB; self::$Connect = new PDO($dsn, USER, PASS, null);
            endif;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        //Seta os atributos para que seja retornado as excessões do banco
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return  self::$Connect;
    }

    public static function retornarConexao()
    {
        return  self::Conectar();
    }
}
