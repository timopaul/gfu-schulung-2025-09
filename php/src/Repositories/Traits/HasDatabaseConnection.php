<?php

declare(strict_types=1);

namespace App\Repositories\Traits;

use PDO;

trait HasDatabaseConnection
{
    private PDO $pdo;

    public function connect(string $host, int $port, string $username, string $password, string $database): self
    {
        $this->pdo = new PDO("mysql:host={$host};port={$port};dbname={$database}", $username, $password);

        return $this;
    }

    protected function executeQuery(string $query): array|bool
    {
        return $this->pdo->query($query)->fetchAll();
    }

}
