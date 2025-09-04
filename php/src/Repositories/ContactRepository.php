<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Repositories\ContactRepositoryInterface;
use App\Models\Contact;
use App\Repositories\Traits\HasDatabaseConnection;

class ContactRepository implements ContactRepositoryInterface
{
    use HasDatabaseConnection;

    public function findAll(): array
    {
        $stmt = 'SELECT * FROM contacts';
        $contacts = $this->executeQuery($stmt);

        return array_map(function ($contact) {
            return new Contact(
                id: (int) $contact['id'],
                firstname: $contact['firstname'],
                lastname: $contact['lastname'],
                title: $contact['title'],
                email: $contact['email'],
                skills: $contact['skills'],
                about: $contact['about'],
            );

        }, $contacts);
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