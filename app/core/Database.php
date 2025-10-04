<?php

Trait Database
{
    private $conn;

    public function __construct(){
        try {
            $dsn = "mysql:host=". DBHOST .";dbname=". DBNAME .";charset=utf8mb4";
            $this->conn = new PDO($dsn, DBUSER, DBPASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(){
        return $this->conn;
    }

    public function query($query, $data = []){
        $connection = $this->getConnection();
        $statement = $connection->prepare($query);
        $success = $statement->execute($data);

        if(!$success){
            return false;
        }

        if(stripos($query, 'SELECT') === 0){
            return $statement->fetchAll(PDO::FETCH_OBJ);
        }else{
            return $statement->rowCount();
        }
    }

    /**
     * Fetch a single row
    */

    public function fetchOne($query, $data = []){
        $connection = $this->getConnection();
        $statement = $connection->prepare($query);
        $statement->execute($data);

        return $statement->fetch(PDO::FETCH_OBJ);
        
    }
}