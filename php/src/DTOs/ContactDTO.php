<?php

namespace App\DTOs;

class ContactDTO extends AbstractDTO
{
    public function __construct(
        private readonly int|null $id = null,
        private string $firstname = '',
        private string $lastname = '',
        private string $title = '',
        private string $email = '',
        private string $skills = '',
        private string $about = '',
    ) { }

    public function getId(): int|null
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return trim($this->firstname);
    }

    public function getLastname(): string
    {
        return trim($this->lastname);
    }

    public function getTitle(): string
    {
        return trim($this->title);
    }

    public function getEmail(): string
    {
        return trim($this->email);
    }

    public function getSkills(): string
    {
        return trim($this->skills);
    }

    public function getAbout(): string
    {
        return trim($this->about);
    }

    public function hasId(): bool
    {
        return null !== $this->getId();
    }

    public function exists(): bool
    {
        return $this->hasId();
    }

    public function validate(): true|array
    {
        $errors = [];

        if (empty($this->getFirstname())) {
            $errors['firstname'] = 'First name is required.';
        }

        if (empty($this->getLastname())) {
            $errors['lastname'] = 'Last name is required.';
        }

        if (empty($this->getEmail()) || ! filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'A valid email is required.';
        }

        return empty($errors) ? true : $errors;

    }

    public static function fromPost(): self
    {
        return new self(
            id: filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?: null,
            firstname: filter_input(INPUT_POST, 'firstname') ?: '',
            lastname: filter_input(INPUT_POST, 'lastname') ?: '',
            title: filter_input(INPUT_POST, 'title') ?: '',
            email: filter_input(INPUT_POST, 'email') ?: '',
            skills: filter_input(INPUT_POST, 'skills') ?: '',
            about: filter_input(INPUT_POST, 'about') ?: '',
        );
    }

}