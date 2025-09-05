<?php

declare(strict_types=1);

use App\Enums\FlashMessageTypeEnum;
use JetBrains\PhpStorm\NoReturn;

#[NoReturn]
function redirect(string $url = 'index.php'): void
{
    header('Location: ' . $url);
    exit;
}

function render(string $template, array $vars = []): void
{
    $flash = getFlash();
    extract($vars);
    ob_start();
    include realpath(__DIR__ . '/../templates') . '/' . $template . '.phtml';
    $content = ob_get_clean();
    include realpath(__DIR__ . '/../templates') . '/layout.phtml';
}

function old(string $name, object|null $object = null): string
{
    if (isset($_SESSION['old'][$name])) {
        $value = $_SESSION['old'][$name];
        unset($_SESSION['old'][$name]);
        return htmlspecialchars((string) $value);
    }

    if (null !== $object) {
        $getter = 'get' . ucfirst($name);
        if (method_exists($object, $getter)) {
            return htmlspecialchars((string) $object->$getter());
        }
    }

    return '';
}

function setFlash(FlashMessageTypeEnum $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type->value,
        'message' => $message,
    ];
}

function getFlash(): array|null
{
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    return null;
}
