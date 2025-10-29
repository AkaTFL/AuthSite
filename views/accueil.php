<!DOCTYPE html>
<html>
    <head>
        <title>Accueil</title>
    </head>
    <body>
    <p>Bienvenue sur ce site</p>
    <a href='/AuthSite/spectacles'>Liste des spectacles</a>
        <?php
            if (isset($_SESSION['user'])) {
                echo "<a href='/AuthSite/logout'>Se déconnecter</a>";
                echo "<a href='/AuthSite/profil'>Mon profil</a>";

                if ($_SESSION['role'] == 'admin') {
                    echo "<a href='/AuthSite/admin'>Ajouter un spectacle</a>";
                }
            } else {
                echo "<a href='/AuthSite/login'>Se connecter</a>";
            }
        ?>
    </body>
</html>
