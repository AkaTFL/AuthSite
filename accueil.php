<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>
    </head>
    <body>
        <p>Bienvenue sur ce site</p>
        <a href='liste_spectacle.php'>Liste des spectacles</a>
        <?php
            if (isset($_SESSION['user'])) {
                echo "<a href='logout.php'>Se déconnecter</a>";
                echo "<a href='profil.php'>Mon profil</a>";
                echo "<a href='reserver.php'>Réserver des places</a>";

                if ($_SESSION['role'] == 'admin') {
                    echo "<a href='ajout_spectacle.php'>Ajouter un spectacle</a>";
                    echo "<a href='admin.php'>Ajouter des spectacles</a>";
                }
            } if (isset($_SESSION['user'])) {
                echo "<a href='login.php'>Se connecter</a>";
            }
        ?>
    </body>
</html>