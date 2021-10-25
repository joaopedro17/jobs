<?php

namespace app\Db;

use PDO;
use PDOException;

class Database
{
    const HOST = 'localhost';

    const NAME = 'php_crud';

    const USER = 'root';

    const PASS = 'root';

    /**
     * table to handle
     * @var String
     */
    private $table;

    /**
     * DB connection 
     * @var PDO
     */
    private $connection;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }
    
    /**
     * create DB connection
     */
    private function setConnection() 
    {
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            die('err: ' . $e->getMessage());
        }
    }

    /**
     * @param String
     * @param Array
     * @return PDOStatment
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;

        } catch (PDOException $e) {
            die('err: ' . $e->getMessage());
        }
    }

    /**
     * @param array 
     * @return integer
     */
    public function insert($values)
    {
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');
        // echo "<prev>"; print_r($fields); echo "</prev>"; exit;

        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

        $this->execute($query,array_values($values));

        $payload = $this->connection->lastInsertId();

        return $payload;
    }

    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        $payload = $this->execute($query);

        return $payload;
    }

    public function update($where, $values)
    {
        $fields = array_keys($values);

        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
        $this->execute($query,array_keys($values));

        return true;
    }

    public function delete($where)
    {
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
    
        $this->execute($query);
    
        return true;
    }
}