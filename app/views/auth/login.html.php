<h1>Login</h1>
<form action="<?= route('authenticate') ?>" method="post">

    <!-- Champ toket csrf -->
    <?= genInputCsrfToken() ?>

    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
    </div>

    <div>
        <label for="pwd">Password</label>
        <input type="text" name="pwd" id="pwd">
    </div>

    <div>
        <button type="submit">Se connecter</button>
    </div>

</form>