<?php

trait HasDatabaseConnection
{
    private \mysqli $connection;

    public function connect(string $host, int $port, string $username, string $password, string $database): self
    {
        $this->connection = new \mysqli($host, $username, $password, $database, $port);

        return $this;
    }

    protected function executeQuery(string $query): array|bool
    {
        $res = $this->connection->query($query);

        if (is_bool($res)) {
            return $res;
        }

        return $res->fetch_all(MYSQLI_ASSOC);
    }

}