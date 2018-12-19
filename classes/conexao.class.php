<?php
/*
 * Constantes de parâmetros para configuração da conexão
 */
// conexao local
define('SGBD', 'mysql');
define('HOST', 'localhost');
define('DBNAME', 'db_games');
define('CHARSET', 'utf8');
define('USER', 'root');
define('PASSWORD', 'root');

class conexao {
    
    /*
     * Atributo estático de conexão
     */
    private static $pdo;


    /*
     * Método estático para retornar uma conexão válida
     * Verifica se já existe uma instância da conexão, caso não, configura uma nova conexão
     */
    public static function getInstance() {

        if (!isset(self::$pdo)) {
            try {
                $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
                switch (SGBD) {
                    case 'mysql':
                        self::$pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . ";", USER, PASSWORD, $opcoes);
                        break;
                    case 'mssql':
                        self::$pdo = new PDO("sqlsrv:server=" . HOST . "; database=" . DBNAME . ";", USER, PASSWORD, $opcoes);
                        break;
                    case 'postgre':
                        self::$pdo = new PDO("pgsql:host=" . HOST . "; dbname=" . DBNAME . ";", USER, PASSWORD, $opcoes);
                        break;
                }
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                print "Erro: " . $e->getMessage();
            }
        }
        return self::$pdo;
    }
}

