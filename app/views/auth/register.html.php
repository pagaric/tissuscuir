<h1>Enregistrement</h1>

<form action="<?= route('create.user') ?>" method="post">

    <!-- Champ toket csrf -->
    <?= genInputCsrfToken() ?>

    <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom">
    </div>

    <div>
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
    </div>

    <div>
        <label for="tel">Téléphone</label>
        <input type="text" name="tel" id="tel">
    </div>

    <div>
        <label for="pwd">Password</label>
        <input type="text" name="pwd" id="pwd">
    </div>

    <div>
        <button type="submit">S'enregistrer</button>
    </div>

</form>