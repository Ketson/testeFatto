<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

class MySql{

	private $db;
	private $ipHost;
	private $nomeBanco;
	private $user;
	private $password;
	private $tabela;

	public function __construct($tabela) {

        //Configurando o acesso ao banco de dados
        $this->ipHost = 'us-cdbr-east-06.cleardb.net';
        $this->nomeBanco = 'heroku_ca59e8b4e18133e';
        $this->user = 'b13b4a5ec73186';
        $this->password = '705eb6ea';
        $this->tabela = $tabela;

        //Conectando ao banco de dados
        $this->db = new PDO('mysql:host=' .$this->ipHost. ';dbname=' . $this->nomeBanco, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function inserir(Array $dados) {
        $campos = implode(", ", array_keys($dados));
        $valores = "'" . implode("' , '", array_values($dados)) . "'";
        
        $sql = " INSERT INTO `{$this->tabela}` ({$campos}) VALUES ({$valores}) ";
        $resultSet = $this->db->prepare($sql);
        
        $retorno = false;
        try {
            $resultSet->execute();
            $retorno = true;
        } catch (PDOException $ex) {
            echo 'Erro inesperado: ' . $ex->getMessage();
            exit;
        }
        return $retorno;
    }

	public function buscar($where = null, $limit = null, $offset = null, $orderby = null) {
        $where = ($where != null ? "WHERE {$where}" : "");
        $limit = ($limit != null ? "LIMIT {$limit}" : "");
        $offset = ($offset != null ? "OFFSET {$offset}" : "");
        $orderby = ($orderby != null ? "ORDER BY {$orderby}" : "");

        $sql = " SELECT * FROM `{$this->tabela}` {$where} {$orderby} {$limit} {$offset}";
        $resultSet = $this->db->prepare($sql);

        $retorno = false;
        try {
            $resultSet->execute();
            $resultSet->setFetchMode(PDO::FETCH_ASSOC);
            $retorno = $resultSet->fetchAll();
        } catch (PDOException $ex) {
            echo 'Erro inesperado: ' . $ex->getMessage();
            exit;
        }
        return $retorno;
    }

    public function atualizar(Array $dados, $where) {
        foreach ($dados as $indice => $val) {
            $campos[] = "{$indice} = '{$val}'";
        }
        $campos_query = implode(", ", $campos);
        $sql = " UPDATE `{$this->tabela}` SET {$campos_query} WHERE {$where}";
        $resultSet = $this->db->prepare($sql);
        
        //echo $sql;
        //exit;

        //Tratamento com PDO e chamada de Excess??o - Usado tambem contra SQL Injection
        $retorno = false;
        try {
            $resultSet->execute();
            $retorno = true;
        } catch (PDOException $ex) {
            echo 'Erro inesperado: ' . $ex->getMessage();
            exit;
        }
        return $retorno;
    }

    public function deletar($where) {
        $sql = " DELETE FROM {$this->tabela} WHERE {$where}";
        $resultSet = $this->db->prepare($sql);

        //Tratamento com PDO e chamada de Excess??o - Usado tambem contra SQL Injection
        $retorno = false;
        try {
            $resultSet->execute();
            $retorno = true;
        } catch (PDOException $ex) {
            echo 'Erro inesperado: ' . $ex->getMessage();
            exit;
        }
        return $retorno;
    }

    public function runQuery($query) {

        $resultSet = $this->db->prepare($query);

        $retorno = false;
        try {
            $resultSet->execute();
            $resultSet->setFetchMode(PDO::FETCH_ASSOC);
            $retorno = $resultSet->fetchAll();
        } catch (PDOException $ex) {
            echo 'Erro inesperado: ' . $ex->getMessage();
            exit;
        }
        return $retorno;
    }
    
}
