<?php
declare(strict_types=1);

class PDOConnection
{
    function connect(): PDO
    {
        $pdo = new PDO('mysql:host=localhost:8889; dbname=expense; charset=utf8mb4', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $pdo;
    }
}