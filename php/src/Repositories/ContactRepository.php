<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Repositories\ContactRepositoryInterface;
use App\Models\Contact;
use App\Repositories\Traits\HasDatabaseConnection;
use PDO;

class ContactRepository implements ContactRepositoryInterface
{
    use HasDatabaseConnection;

    public function findAll(): array
    {
        $stmt = 'SELECT * FROM contacts';
        $contacts = $this->executeQuery($stmt);

        return array_map([$this, 'mapToContact'], $contacts);
    }

    public function findById(int $id): Contact
    {
        $stmt = 'SELECT * FROM contacts WHERE id = :id';
        $query = $this->pdo->prepare($stmt);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $contact = $query->fetch(PDO::FETCH_ASSOC);

        return $this->mapToContact($contact);
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

    private function mapToContact(array $data): Contact
    {
        return new Contact(
            id: (int) $data['id'],
            firstname: $data['firstname'],
            lastname: $data['lastname'],
            title: $data['title'],
            email: $data['email'],
            skills: $data['skills'],
            about: $data['about'],
        );
    }
}