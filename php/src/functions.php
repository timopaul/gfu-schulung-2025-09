<?php

declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

#[NoReturn]
function redirect(string $url = 'index.php'): void
{
    header('Location: ' . $url);
    exit;
}
