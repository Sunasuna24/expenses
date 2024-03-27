<?php
declare(strict_types=1);
require_once '../../database/pdo.php';

class Expense
{
    private $amount;
    private $category;
    private $purpose;

    public function __construct(int $amount, string $category_slug, string $purpose)
    {
        $this->amount = $amount;
        $this->purpose = $purpose;

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
    public function create(): void
    {
        try {
            $pdo_connection = new PDOConnection();
            $pdo = $pdo_connection->connect();

            $query = "INSERT INTO expenses(amount, purpose, category_id) VALUES (:amount, :purpose, :category_id);";
            $statement = $pdo->prepare($query);
            $statement->bindValue(':amount', $this->amount, PDO::PARAM_INT);
            $statement->bindValue(':purpose', $this->purpose, PDO::PARAM_STR);
            $statement->bindValue(':category_id', $this->category["id"], PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}