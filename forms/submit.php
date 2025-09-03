<?php

declare(strict_types=1);

include_once 'functions.php';

if ( ! filter_has_var(INPUT_POST, 'submit')) {
    redirect();
}

$errors = [];

$name = filter_input(INPUT_POST, 'name');
if ('' === trim($name)) {
    $errors['name'] = 'Bitte gib deinen Namen an.';
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
if (false === $email) {
    $errors['email'] = 'Bitte gib eine gültige E-Mail-Adresse an.';
    $email = '';
} elseif ('' === trim($email)) {
    $errors['email'] = 'Bitte gib deine E-Mail-Adresse an.';
}

$message = filter_input(INPUT_POST, 'message');
if ('' === trim($message)) {
    $errors['message'] = 'Bitte gib eine Nachricht an.';
}

if (0 < count($errors)) {

    $params = [
        'name' => $name,
        'email' => $email,
        'message' => $message,
        'errors' => $errors,
    ];
    $url = 'index.php?' . http_build_query($params);

    redirect($url);
}

echo '<pre>$name: ' . print_r($name, true) . '</pre>';
echo '<pre>$email: ' . print_r($email, true) . '</pre>';
echo '<pre>$message: ' . print_r($message, true) . '</pre>';
