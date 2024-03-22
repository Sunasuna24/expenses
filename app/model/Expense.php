<?php
declare(strict_types=1);
require_once '../../database/pdo.php';

class Expense
{
    private $amount;
    private $category;

    public function __construct(int $amount, string $category_slug)
    {
        $this->amount = $amount;

        try {
            $pdo_connection = new PDOConnection();
            $pdo = $pdo_connection->connect();

            $statement = $pdo->prepare('SELECT * FROM categories WHERE slug = :slug LIMIT 1;');
            $statement->bindValue(':slug', $category_slug, PDO::PARAM_STR);
            $statement->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
        $fetched_category = $statement->fetch(PDO::FETCH_ASSOC);
        $this->category = $fetched_category;
    }

    /**
     * 新しい支出を追加する。
     */
    public function create(): self
    {
        return $this;
    }
}