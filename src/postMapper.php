<?php
declare(strict_types=1);

namespace Blog;

use Mockery\Exception;
use PDO;

class postMapper
{
    /**
     * @var Database
     */
    private Database $database;

    /**
     * postMapper constructor.
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
        $statement = $this->database->getConnection()->prepare('SELECT * FROM `post` WHERE `url_key` = :url_key');
        $statement->execute([
            'url_key' => $urlKey
        ]);

        $result = $statement->fetchAll();

        return array_shift($result);
    }

    public function getList(int $page = 1, int $limit = 2, string $derection = 'DESC'): ?array
    {
        if (!in_array($derection, ['DESC', 'ASC'])){
            throw new Exception('The derection is not supported!');
        }

        $start = ($page - 1) * $limit;
        $statement = $this->database->getConnection()->prepare(
            'SELECT * FROM `post` ORDER BY `published_date` ' . $derection .
            ' LIMIT ' . $start . ',' . $limit
        );

        $statement->execute();

        return $statement->fetchAll();
    }

    public function getTotalCount(): int
    {
        $statement = $this->database->getConnection()->prepare(
            'SELECT count(`id`) as total FROM `post`'
        );

        $statement->execute();

        return (int) ($statement->fetchColumn() ?? 0);
    }
}