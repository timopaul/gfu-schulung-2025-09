<?php

declare(strict_types=1);

use App\Enums\ContactActionEnum;
use App\Repositories\ContactRepository;

require_once realpath(__DIR__) . '/src/autoloader.php';

$dbConfig = require dirname(__DIR__ . '/..') . '/config/database.php';

$contactRepository = new ContactRepository();
$contactRepository->connect(
    $dbConfig['host'],
    $dbConfig['port'],
    $dbConfig['username'],
    $dbConfig['password'],
    $dbConfig['database'],
);

$requestedAction = filter_has_var(INPUT_GET, 'action')
    ? filter_input(INPUT_GET, 'action')
    : '';
$action = ContactActionEnum::tryFrom($requestedAction) ?? ContactActionEnum::List;

switch ($action) {
    case ContactActionEnum::List:
        $contacts = $contactRepository->findAll();
        include __DIR__ . '/templates/contacts/index.phtml';
        break;

    case ContactActionEnum::Edit:
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (false === $id || null === $id) {
            redirect();
        }
        $contact = $contactRepository->findById($id);

        echo '<pre>$contact: ' . print_r($contact, true) . '</pre>';

        break;
}


#echo '<pre>$dbConfig: ' . print_r($dbConfig, true) . '</pre>';
#echo '<pre>$contacts: ' . print_r($contacts, true) . '</pre>';