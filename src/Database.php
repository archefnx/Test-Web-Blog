<?php

<<<<<<< HEAD
declare(strict_types=1);

namespace Blog;

use InvalidArgumentException;
=======
namespace Blog;

>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
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
<<<<<<< HEAD
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        try {
            $this->connection = $connection;
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
=======
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
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
        }
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
<<<<<<< HEAD
        return $this->connection;
    }
}
=======
       return $this->connection;
    }

}
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
