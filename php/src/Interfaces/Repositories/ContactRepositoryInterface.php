<?php

declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\DTOs\ContactDTO;
use App\Models\Contact;

interface ContactRepositoryInterface
{
    public function findAll(): array;

    public function findById(int $id): Contact;

    public function create(ContactDTO $data): int|false;

    public function update(int $id, ContactDTO $data): bool;

    public function delete(int $id): bool;
}