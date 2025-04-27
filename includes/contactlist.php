<?php

function loadContacts() {
    $contactsJson = file_get_contents(__DIR__ . '/../contacts.json');
    $contacts = json_decode($contactsJson, true);
    return $contacts ?: [];
}

function saveContacts(array $contacts) {
    file_put_contents(__DIR__ . '/../contacts.json', json_encode($contacts, JSON_PRETTY_PRINT));
}
