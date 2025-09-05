<?php

use App\Interfaces\Repositories\ContactRepositoryInterface;
use App\Repositories\ContactRepository;

return [
    ContactRepositoryInterface::class => DI\autowire(ContactRepository::class),
];