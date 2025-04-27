<?php

session_start();
// session_unset();
// session_destroy();

$error = '';

//si la clé 'contacts' n'esxiste pas dans $_SESSION
if (!isset($_SESSION['contacts'])) {
    require_once __DIR__ . "/includes/contacts.php";
    $_SESSION['contacts'] = $contacts;
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContactName = $_POST['name'] ?? '';
    $newContactEmail = $_POST['email'] ?? '';

    if ($newContactName && $newContactEmail) {
        array_unshift($_SESSION['contacts'], [
            'id' => uniqid(),
            'name' => $newContactName,
            'email' => $newContactEmail,
            'favorite' => false,
        ]);
    } else {
        $error = 'Il faut renseigner un nom ou un email !';
    }
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once __DIR__ . '/includes/head.php' ?>
    <title>Contact Book</title>
</head>

<body>
    <header>
        <?php require_once __DIR__ . '/includes/header.php' ?>
    </header>

    <section>
        <form action="/" method="POST">
            <input type="text"
                name="name"
                autocomplete="off"
                autofocus
                value="<?= htmlspecialchars($contact['name']) ?>" ;
                placeholder="Nom complet">

            <input type="email"
                name="email"
                autocomplete="off"
                autofocus
                value="<?= htmlspecialchars($contact['email']) ?>" ;
                placeholder="email">
            <button type="submit">Ajouter</button>
        </form>

        <?php if ($error): ?>
            <p><?= $error ?></p>
        <?php endif; ?>

        <ul>
            <?php foreach ($_SESSION['contacts'] as $contacts): ?>
                <li>
                    <span><?= $contacts['name'] ?></span>
                    <span><?= $contacts['email'] ?></span>
                    <a href="/edit-contacts.php?id=<?= $contacts['id'] ?>">
                        <button>
                            <?= $contacts['favorite'] ? 'Annuler' : 'Favoris' ?>
                        </button>
                    </a>

                    <a href="/remove.php?id=<?= $contacts['id'] ?>">
                        <button>
                            Supprimer
                        </button>
                    </a>



                    <form action="/modify.php?id=<?= $contact['id'] ?>" method="POST">
                        <input type="text"
                            name="modifiedName"
                            autocomplete="off"
                            autofocus
                            value="<?= htmlspecialchars($contact['modifiedname']) ?>" 
                            placeholder="Nom complet">

                        <input type="email"
                            name="modifiedEmail"
                            autocomplete="off"
                            autofocus
                            value="<?= htmlspecialchars($contact['modifiedemail']) ?>" 
                            placeholder="email">

                        <a href="/modify.php?id=<?= $contacts['id'] ?>">
                            <button type="submit">Modifier</button>
                        </a>
                    </form>

                </li>
            <?php endforeach; ?>
        </ul>

    </section>

    <footer>
        <?php require_once __DIR__ . '/includes/footer.php' ?>
    </footer>
</body>

</html>