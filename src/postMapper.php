<?php

declare(strict_types=1);

namespace Blog;

use Exception;
use PDO;

class PostMapper
{
    /**
     * @var Database
     */
    private Database $database;

    /**
<<<<<<< HEAD
     * PostMapper constructor.
=======
     * postMapper constructor.
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param string $urlKey
     * @return array|null
     */
    public function getByUrlKey(string $urlKey): ?array
    {
<<<<<<< HEAD
        $statement = $this->getConnection()->prepare('SELECT * FROM post WHERE url_key = :url_key');
=======
        $statement = $this->database->getConnection()->prepare('SELECT * FROM `post` WHERE `url_key` = :url_key');
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
        $statement->execute([
            'url_key' => $urlKey
        ]);

        $result = $statement->fetchAll();

        return array_shift($result);
    }

    /**
     * @param int $page
     * @param int $limit
     * @param string $direction
     * @return array|null
     * @throws Exception
     */
    public function getList(int $page = 1, int $limit = 2, string $direction = 'ASC'): ?array
    {
        if (!in_array($direction, ['DESC', 'ASC'])) {
            throw new Exception('The direction is not supported.');
        }

        $start = ($page - 1) * $limit;
<<<<<<< HEAD
        $statement = $this->getConnection()->prepare(
            'SELECT * FROM post ORDER BY published_date ' . $direction .
=======
        $statement = $this->database->getConnection()->prepare(
            'SELECT * FROM `post` ORDER BY `published_date` ' . $derection .
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
            ' LIMIT ' . $start . ',' . $limit
        );

        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
<<<<<<< HEAD
        $statement = $this->getConnection()->prepare(
            'SELECT count(id) as total FROM post'
=======
        $statement = $this->database->getConnection()->prepare(
            'SELECT count(`id`) as total FROM `post`'
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
        );

        $statement->execute();

        return (int) ($statement->fetchColumn() ?? 0);
    }

    /**
     * @return PDO
     */
    private function getConnection(): PDO
    {
        return $this->database->getConnection();
    }
}
