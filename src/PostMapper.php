<?php

declare(strict_types=1);

namespace Blog;

use Exception;
use PDO;
use mysqli;

class PostMapper
{
    /**
     * @var Database
     */
    private Database $database;

    /**
     * PostMapper constructor.
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
      $this->setEncoding('utf8mb4');
      
        $statement = $this->getConnection()->prepare('SELECT * FROM post WHERE url_key = :url_key');
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
      
      $this->setEncoding('utf8mb4');

        $start = ($page - 1) * $limit;
        $statement = $this->getConnection()->prepare(
            'SELECT * FROM post ORDER BY published_date ' . $direction .
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
        $statement = $this->getConnection()->prepare(
            'SELECT count(id) as total FROM post'
        );

        $statement->execute();

        return (int) ($statement->fetchColumn() ?? 0);
    }
  
  private function setEncoding(string $encoding)
    {
        $statement = $this->getConnection()->prepare(
            'SET NAMES ' . $encoding
        );
        $statement->execute();
    }

    /**
     * @return PDO
     */
    private function getConnection(): PDO
    {
        return $this->database->getConnection();
    }
}
