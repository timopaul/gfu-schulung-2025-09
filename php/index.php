<?php

declare(strict_types=1);

$srcPath = realpath(__DIR__) . '/src/';

require $srcPath . 'Interfaces/Repositories/ContactRepositoryInterface.php';
require $srcPath . 'Repositories/Traits/HasDatabaseConnection.php';
require $srcPath . 'Repositories/ContactRepository.php';

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


echo '<pre>$dbConfig: ' . print_r($dbConfig, true) . '</pre>';
echo '<pre>$contacts: ' . print_r($contacts, true) . '</pre>';