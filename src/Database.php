<?php

namespace Blog;

use PDO;
use PDOException;

class Database
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * Database constructor.
     * @param $dsn
     * @param null $username
     * @param null $password
     */
    public function __construct($dsn, $username = null, $password = null)
    {
        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception){
            throw new \InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
       return $this->connection;
    }

}