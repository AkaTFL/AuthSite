<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Liste des spectacles</title>
    </head>
    <body>
        <h1>Liste des spectacles</h1>
        <?php
            foreach ($spectacles as $s) {
                echo "{$s['date']} — {$s['nom']} — {$s['lieu']} — {$s['prix_eur']} €<br>";
                echo "<a href='/spectacles/details?spectacle_id={$s['id']}'>Plus d'infos</a> | ";
                echo "<a href='/reserver?spectacle_id={$s['id']}'>Réserver</a>";
                echo "<hr>";
            }
        ?>
        <p><a href='/'>← Retour à l'accueil</a></p>
    </body>
</html>
