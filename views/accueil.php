<!DOCTYPE html>
<html>
    <head>
        <title>Accueil</title>
    </head>
    <body>
        <p>Bienvenue sur ce site</p>
        <a href='/spectacles'>Liste des spectacles</a>
        <?php
            if (isset($_SESSION['user'])) {
                echo "<a href='/logout'>Se déconnecter</a>";
                echo "<a href='/profil'>Mon profil</a>";

                if ($_SESSION['role'] == 'admin') {
                    echo "<a href='/admin'>Ajouter un spectacle</a>";
                }
            } else {
                echo "<a href='/login'>Se connecter</a>";
            }
        ?>
    </body>
</html>
