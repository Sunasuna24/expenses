<?php
declare(strict_types=1);
require_once '../../database/pdo.php';

class Category
{
    private $name;
    private $slug;

    public function __construct(string $name, string $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * 新しいカテゴリーを新規で追加する
     */
    public function create(): void
    {
        try {
            $pdo_connection = new PDOConnection();
            $pdo = $pdo_connection->connect();
    
            $statement = $pdo->prepare('INSERT INTO categories(name, slug) VALUES(:name, :slug)');
            $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
            $statement->bindValue(':slug', $this->slug, PDO::PARAM_STR);
            $statement->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}