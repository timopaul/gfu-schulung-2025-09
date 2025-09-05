<?php

namespace App\Enums;

enum FlashMessageTypeEnum: string
{
    case Success = 'success';
    case Error = 'error';
    case Warning = 'warning';
    case Info = 'info';
}
