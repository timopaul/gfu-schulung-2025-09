<?php

declare(strict_types=1);

function redirect(string $url = 'index.php'): void
{
    header('Location: ' . $url);
    exit;
}
