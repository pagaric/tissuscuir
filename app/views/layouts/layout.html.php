<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mon super blog' ?></title>
    <!-- <link rel="stylesheet" href="<?= asset('css/app.css') ?>"> -->
</head>

<body>
    <?php d($_SESSION) ?>
    <nav>
        <a href="<?= route('accueil') ?>">TissusCuir</a>

        <ul>
            <li><a href="<?= route('accueil') ?>">Accueil</a></li>
            <li><a href="<?= route('allUsers') ?>">Utilisateurs</a></li>
        </ul>
        <ul>
            <li><a href="<?= route('register') ?>">Register</a></li>
            <li><a href="<?= route('login') ?>">Login</a></li>
            <li><a href="<?= route('logout') ?>">Logout</a></li>
        </ul>
    </nav>
    <p><a href="<?= route('showHash', ['pass']) ?>">lien vers hash</a></p>
    
    <!-- Affichage d'éventuels messages -->
    <?= '<p>' .getIfHasFlashMessage('messages','error'). '</p>' ?>
    <?= '<p>' .getIfHasFlashMessage('messages', 'success'). '</p>' ?>

    <div>
        <?= $content ?>
    </div>
    <hr>
    Footer
</body>

</html>