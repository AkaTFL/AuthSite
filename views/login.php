<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="/AuthSite/assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>

        <?php if (isset($error) && $error): ?>
            <p style="color: red;"><strong><?php echo htmlspecialchars($error); ?></strong></p>
        <?php endif; ?>

        <form method="post" action="/AuthSite/login">
            <label>Nom d'utilisateur :<br>
                <input type="text" name="username" required>
            </label><br><br>

            <label>Mot de passe :<br>
                <input type="password" name="password" required>
            </label><br><br>

            <button type="submit">Se connecter</button>
        </form>

        <p><small>Test : admin/admin ou user/user</small></p>
        <p><a href="/AuthSite/">Retour à l'accueil</a></p>
    </div>
</body>
</html>
