<?php

namespace Blog;

use PDO;

class registrator
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * Registration constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param $login
     * @param $name
     * @param $email
     * @param $password
     */
    public function saveUser($login, $name, $email, $password)
    {
        $statement = $this->connection->prepare(
            "INSERT INTO `users` (`login`, `name`, `email`, `password`) 
                            VALUES ('$login', '$name','$email', '$password')"
        );

        $statement->execute();
    }

    /**
     * @param $sql
     * @return array
     */
    public function query($sql): array
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false)
            return [];
        else
            return $result;
    }

}