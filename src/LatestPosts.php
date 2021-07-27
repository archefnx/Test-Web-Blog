<?php

declare(strict_types=1);

namespace Blog;

use mysqli;

class LatestPosts
{
    /**
     * @var Database
     */
    private Database $database;

    /**
     * LatestPosts constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param int $limit
     * @return array|null
     */
    public function get(int $limit): ?array
    {
        $this->setEncoding('utf8mb4');

        $statement = $this->database->getConnection()->prepare(
            'SELECT * FROM post ORDER BY published_date DESC LIMIT ' . $limit
        );

        $statement->execute();

        return $statement->fetchAll();
    }

    private function setEncoding(string $encoding)
    {
        $mysqli = new mysqli("localhost", "mysql", "mysql", "topsite");
        $mysqli->set_charset("$encoding");

        $statement = $this->database->getConnection()->prepare(
            'SET NAMES ' . $encoding
        );
        $statement->execute();
    }
}
