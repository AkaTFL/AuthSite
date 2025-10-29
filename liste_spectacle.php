<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Liste des spectacles</title>
    </head>
    <body>
        <?php
            $spectacles = include 'spectacles.php';

            foreach ($spectacles as $s) {
                echo "{$s['date']} — {$s['nom']} — {$s['lieu']} — {$s['prix_eur']} €<br>";
                echo "<a href='reserver.php?spectacle_id={$s['id']}'>Réserver</a>";
            }
        ?>
    </body>
</html>