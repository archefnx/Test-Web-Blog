<?php

namespace Blog;

use PDO;

class registrator
{
    /**
     * @var Database
     */
    private Database $database;

    /**
     * Registration constructor.
     * @param Database $datavase
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param $login
     * @param $name
     * @param $email
     * @param $password
     */
    public function saveUser($login, $name, $email, $password)
    {
        $statement = $this->database->getConnection()->prepare(
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
        $statement = $this->database->getConnection()->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false)
            return [];
        else
            return $result;
    }

}