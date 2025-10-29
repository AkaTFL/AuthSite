<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Liste des spectacles</title>
    </head>
    <body>
        <h1>Liste des spectacles</h1>
        <p><a href='/AuthSite/'>Retour à l'accueil</a></p>
        <p><a href='/AuthSite/profil'>Voir vos réservations</a></p>
        <?php
            foreach ($spectacles as $s) {
                echo "{$s['date']} — {$s['nom']} — {$s['lieu']} — {$s['prix_eur']} €<br>";
                echo "<a href='/AuthSite/spectacles/details?spectacle_id={$s['id']}'>Plus d'infos</a> | ";
                echo "<a href='/AuthSite/reserver?spectacle_id={$s['id']}'>Réserver</a>";
                echo "<hr>";
            }
        ?>
    </body>
</html>
