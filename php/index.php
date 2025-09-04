<?php

declare(strict_types=1);

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

$contacts = $contactRepository->findAll();

include __DIR__ . '/templates/contacts/index.phtml';

#echo '<pre>$dbConfig: ' . print_r($dbConfig, true) . '</pre>';
#echo '<pre>$contacts: ' . print_r($contacts, true) . '</pre>';