<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modifiedName = $_POST['name'] ?? '';
    $modifiedEmail = $_POST['email'] ?? '';
    $id = $_GET['id'] ?? '';

    if ($modifiedName && $modifiedEmail && $id) {
        foreach ($_SESSION['contacts'] as $key => $contact) {
            // Recherche et Mise à jour du contact trouvé
            if ($contact['id'] === $id) {
                $_SESSION['contacts'][$key]['name'] = $modifiedName;
                $_SESSION['contacts'][$key]['email'] = $modifiedEmail;
                break;
            }
        }
    } else {
        $_SESSION['error'] = 'Nom et email requis pour modifier le contact !';
    }
}

header('Location: /');
exit;
?>
