<?php

function greeting(string $firstName = 'John', $lastName = 'Doe'): string
{
    $name = formatName($firstName, $lastName);

    $hour = date('H');
    if ($hour < 12) {
        return "Guten Morgen {$name}!";
    }

    if ($hour < 18) {
        return "Guten Tag {$name}!";
    }

    return "Guten Abend {$name}!";
}

function formatName(string $firstName, string $lastName): string
{
    $firstName = uniformName($firstName);
    $lastName = uniformName($lastName);
    return "{$lastName}, {$firstName}";
}

function uniformName(string $name): string
{
    return ucfirst(strtolower($name));
}
