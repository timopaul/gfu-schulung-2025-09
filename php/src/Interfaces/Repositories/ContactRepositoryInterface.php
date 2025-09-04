<?php

declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\Contact;

interface ContactRepositoryInterface
{
    public function findAll(): array;

    public function findById(int $id): Contact;

    public function create(array $data): int;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}