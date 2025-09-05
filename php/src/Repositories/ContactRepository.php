<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\ContactDTO;
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

    public function create(ContactDTO $data): int|false
    {
        $stmt = <<<SQL
            INSERT INTO contacts 
            SET firstname = :firstname,
                lastname = :lastname,
                title = :title,
                email = :email,
                skills = :skills,
                about = :about
        SQL;
        $query = $this->pdo->prepare($stmt);
        $this->bindValues($query, $data);

        if ( ! $query->execute()) {
            return false;
        }

        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, ContactDTO $data): bool
    {
        $stmt = <<<SQL
            UPDATE contacts
            SET firstname = :firstname,
                lastname = :lastname,
                title = :title,
                email = :email,
                skills = :skills,
                about = :about
            WHERE id = :id
        SQL;

        $query = $this->pdo->prepare($stmt);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $this->bindValues($query, $data);

        return $query->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = 'DELETE FROM contacts WHERE id = :id';
        $query = $this->pdo->prepare($stmt);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        return $query->execute();
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

    public function bindValues(false|\PDOStatement $query, ContactDTO $data): self
    {
        $query->bindValue(':firstname', $data->getFirstname());
        $query->bindValue(':lastname', $data->getLastname());
        $query->bindValue(':title', $data->getTitle());
        $query->bindValue(':email', $data->getEmail());
        $query->bindValue(':skills', $data->getSkills());
        $query->bindValue(':about', $data->getAbout());

        return $this;
    }
}