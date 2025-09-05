<?php

declare(strict_types=1);

use App\DTOs\ContactDTO;
use App\Enums\ContactActionEnum;
use App\Enums\FlashMessageTypeEnum;
use App\Repositories\ContactRepository;

require_once realpath(__DIR__) . '/src/autoloader.php';

session_start();

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
        render('contacts/list', [
            'title' => 'Kontakte',
            'contacts' => $contactRepository->findAll(),
        ]);
        break;

    case ContactActionEnum::Create:
        render('contacts/form', [
            'title' => 'Neuen Kontakt anlegen',
            'errors' => $_SESSION['errors'] ?? [],
        ]);
        unset($_SESSION['errors']);
        break;

    case ContactActionEnum::Edit:
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (false === $id || null === $id) {
            redirect();
        }
        $contact = $contactRepository->findById($id);

        render('contacts/form', [
            'title' => "Kontakt von <em>{$contact->getName()}</em> bearbeiten",
            'contact' => $contact,
            'errors' => $_SESSION['errors'] ?? [],
        ]);
        unset($_SESSION['errors']);
        break;

    case ContactActionEnum::Save:

        $dto = ContactDTO::fromPost();

        $res = $dto->validate();
        if (is_array($res) && ! empty($res)) {
            $_SESSION['errors'] = $res;
            $action = $dto->hasId() ? ContactActionEnum::Edit : ContactActionEnum::Create;
            $url = 'index.php?action=' . $action->value;
            if ($dto->hasId()) {
                $url .= '&id=' . $dto->getId();
            }
            $dto->asOld();
            redirect($url);
        }

        if ($dto->hasId()) {
            $res = $contactRepository->update($dto->getId(), $dto);
            setFlash(FlashMessageTypeEnum::Success, 'Contact updated successfully.');
        } else {
            $res = $contactRepository->create($dto);
            setFlash(FlashMessageTypeEnum::Success, 'Contact created successfully.');
        }

        redirect();
        break;

    case ContactActionEnum::Delete:
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (false !== $id && null !== $id) {
            $contactRepository->delete($id);
            setFlash(FlashMessageTypeEnum::Success, 'Contact deleted successfully.');
        } else {
            setFlash(FlashMessageTypeEnum::Error, 'Invalid contact ID.');
        }

        redirect();
        break;
}
