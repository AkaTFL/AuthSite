<!DOCTYPE html>
<html>
    <head>
        <title>Accueil</title>
        <link rel="stylesheet" href="/AuthSite/assets/style.css">
    </head>
    <body>
        <div class="container">
        <h1>Bienvenue sur ce site</h1>
    <a href='/AuthSite/spectacles'>Liste des spectacles</a><br>
        <?php
            if (isset($_SESSION['user'])) {
                echo "<a href='/AuthSite/logout'>Se déconnecter</a><br>";
                echo "<a href='/AuthSite/profil'>Mon profil</a><br>";

                if ($_SESSION['role'] == 'admin') {
                    echo "<a href='/AuthSite/admin'>Ajouter un spectacle</a><br>";
                }
            } else {
                echo "<a href='/AuthSite/login'>Se connecter</a><br>";
            }
        ?>
        </div>
    </body>
</html>
