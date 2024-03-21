<?php
declare(strict_types=1);
require_once '../../database/pdo.php';

class Expenses
{
    private $amount;
    private $category;

    public function __construct(int $amount, string $category)
    {
        $this->amount = $amount;
        $this->category = $category;
    }
}