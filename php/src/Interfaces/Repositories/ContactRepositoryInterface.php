<?php

declare(strict_types=1);

interface ContactRepositoryInterface
{
    public function findAll(): array;

    public function findById(int $id): array;

    public function create(array $data): int;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}