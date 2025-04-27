<?php

session_start();

require_once __DIR__ . "/includes/contacts.php";

$id = $_GET['id'] ?? '';
$contacts = &$_SESSION['contacts'] ?? [];

if ($id && count($contacts)) {
    $contactsIndex = array_search($id, array_column($contacts, 'id'));

    if ($contactsIndex !== false) {
        $contacts[$contactsIndex]['favorite'] = !$contacts[$contactsIndex]['favorite'];
    }
}

header('Location: /');
exit;
