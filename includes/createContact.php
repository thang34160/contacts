<?php

session_start();
require_once __DIR__ . "/contacts.php";
$id = $_GET['id'] ?? '';
$contacts = &$_SESSION['contacts'] ?? [];

if ($id && count($contacts)) {
    $contactsIndex = array_search($id, array_column($contacts, 'id'));
    if ($contactsIndex !== false) {
        array_splice($contacts, $contactsIndex, 1);
    }
}

header('location:/');
    
