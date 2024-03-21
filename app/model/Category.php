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

    public function create(): void
    {
        $pdo = connect();
        var_dump($pdo);
    }
}