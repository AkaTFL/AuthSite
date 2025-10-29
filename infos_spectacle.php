<!DOCTYPE html>
<html>
    <head>
        <title>Informations spectacle</title>
    </head>
    <body>
        <?php

            $spectacle_id = isset($_GET['spectacle_id']) ? (int)$_GET['spectacle_id'] : null;

            if ($spectacle_id === null) {
                echo "<p>Aucun spectacle spécifié.</p>";
            } else {

                $spectacles = include 'donnees/spectacles.php';

                $spectacle_trouve = null;
                foreach ($spectacles as $s) {
                    if ($s['id'] == $spectacle_id) {
                        $spectacle_trouve = $s;
                        break;
                    }
                }

                if ($spectacle_trouve === null) {
                    echo "<p>Spectacle non trouvé.</p>";
                } else {
                    echo "<h1>Informations du spectacle</h1>";
                    echo "<p><strong>ID :</strong> " . $spectacle_trouve['id'] . "</p>";
                    echo "<p><strong>Nom :</strong> " . $spectacle_trouve['nom'] . "</p>";
                    echo "<p><strong>Lieu :</strong> " . $spectacle_trouve['lieu'] . "</p>";
                    echo "<p><strong>Prix :</strong> " . $spectacle_trouve['prix_eur'] . " €</p>";
                    echo "<p><strong>Date :</strong> " . $spectacle_trouve['date'] . "</p>";
                    
                    echo "<br>";
                    echo "<a href='reserver.php?spectacle_id=" . $spectacle_trouve['id'] . "'>Réserver ce spectacle</a>";
                    echo " | ";
                    echo "<a href='liste_spectacle.php'>Retour à la liste</a>";
                }
            }
        ?>
    </body>
</html>
