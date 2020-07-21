<?php


namespace App\Tools;

use PDO;
use http\Exception;

class DatabaseTools
{
    private $host;
    private $dbName;
    private $user;
    private $password;

    private $dsn;

    private $pdo;
    public function __construct($host, $dbName, $user, $password)
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->password = $password;

        $this->dsn = "mysql:host=$host;dbname=$dbName";
        $this->initDatabase();
    }



    public function initDatabase(){
        $this->pdo = new PDO($this->dsn, $this->user, $this->password);
    }

    public function executeQuery($SQL){
            $results = $this->pdo->query($SQL);
            if (!is_bool($results)){

            return $results->fetchAll();}
            else {

                return $fail = true;
            }


    }
    public function selectWhere($tableName, $param, $row){
        $results = $this->pdo->query("SELECT * FROM $tableName WHERE '$row' = '$param'");

        return $results->fetchAll();
    }

    public function selectByNameInTable($tableName, $name){
        $result = $this->pdo->query("SELECT * FROM $tableName WHERE name = '$name'");
        return $result->fetch();
    }



    public function insertQuery($sql, $params) {
        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $param){

            $stmt->bindParam($param['paramKey'], $param['paramValue']);
        }
        $stmt->execute();
    }

    public function lastId(){
        return $this->pdo->lastInsertId();
    }

    public function getError(){
        return $this->pdo->errorInfo();
    }

    public function setAttribute(){
        return $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    public function countRep($rId){
        $result = $this->pdo->query("SELECT COUNT(reponse_id) from repondant_reponse where reponse_id = '$rId'");
        return $result->fetch();
    }

}