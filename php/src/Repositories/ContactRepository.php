<?php

class ContactRepository implements ContactRepositoryInterface
{
    use HasDatabaseConnection;

    public function findAll(): array
    {
        $stmt = 'SELECT * FROM contacts';
        return $this->executeQuery($stmt);
    }

    public function findById(int $id): array
    {
        // TODO: Implement findById() method.
        return [];
    }

    public function create(array $data): int
    {
        // TODO: Implement create() method.
        return 0;
    }

    public function update(int $id, array $data): bool
    {
        // TODO: Implement update() method.
        return true;
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
        return true;
    }
}