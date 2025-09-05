<?php

namespace App\Enums;

enum ContactActionEnum: string
{
    case List = 'list';
    case Create = 'create';
    case Edit = 'edit';

    case Save = 'save';
    case Delete = 'delete';
}
