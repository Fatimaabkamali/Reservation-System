<?php

namespace database;

use PDO;
use PDOException;

class Database{

    private $connection;
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    private $dbHost = DB_HOST;
    private $dbUserName = DB_USERNAME;
    private $dbName = DB_NAME;
    private $dbPassword = DB_PASSWORD;

    function __construct()
    {
        try
        {
            $this->connection = new PDO("mysql:host=" . $this->dbHost. ";dbname=" . $this->dbName, $this->dbUserName, $this->dbPassword, $this->options);
          
        }
        catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }


    
    public function select($sql, $values = null)
    {
        try{
            $stmt = $this->connection->prepare($sql);
            if($values == null)
            {
                $stmt->execute();
            }
            else
            {
                $stmt->execute($values);
            }
            $result = $stmt;
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }


    // insert('users', ['username', 'password', 'age'], ['hassank2', '1234', 30]);
    public function insert($tableName, $fields, $values)
    {
        try{
            // 'username' => 'hassank2', 'password' => '1234', 'age' => 30
            $stmt = $this->connection->prepare("INSERT INTO ".$tableName."(".implode(', ', $fields)." , created_at) VALUES ( :" . implode(', :', $fields) . " , now() );");
            $stmt->execute(array_combine($fields, $values));
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    // update('users', 2, ['username', 'password'], ['alik2', 12345]);
    public function update($tableName, $data, $whereClause, $whereValues)
{
    $sql = "UPDATE " . $tableName . " SET ";

    // ساخت رشته SET
    $setParts = [];
    foreach ($data as $field => $value) {
        if ($value !== null && $value !== '') {
            $setParts[] = "`$field` = ?";
        } else {
            $setParts[] = "`$field` = NULL";
        }
    }

    $sql .= implode(', ', $setParts);
    $sql .= ", updated_at = NOW()";
    $sql .= " WHERE " . $whereClause;

    try {
        $stmt = $this->connection->prepare($sql);

        // مقادیر برای SET فقط مقادیر non-null
        $dataValues = array_filter(array_values($data), function($v) {
            return $v !== null && $v !== '';
        });

        // bind values: [SET values..., WHERE values...]
        $stmt->execute(array_merge($dataValues, $whereValues));

        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}


    // delete('users', 2);
    public function delete($tableName, $id)
    {
        $sql = "DELETE FROM " . $tableName . " WHERE id = ? ;";
        try{
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return true;
        }

        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }



    public function createTable($sql)
    {
        try{
            $this->connection->exec($sql);
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        
    }


}