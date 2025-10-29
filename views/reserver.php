<!DOCTYPE html>
<html>
    <head>
        <title>Réservation - <?php echo isset($spectacle) ? $spectacle['nom'] : ''; ?></title>
    </head>
    <body>
        <?php if (isset($success) && $success): ?>
            <p>✅ Réservation enregistrée pour <strong><?php echo $spectacle['nom']; ?></strong> (<?php echo $qty; ?> billet(s)).</p>
            <p><a href="/profil">Voir mes réservations</a> | <a href="/spectacles">Retour à la liste</a></p>
        <?php else: ?>
            <h1>Réserver : <?php echo $spectacle['nom']; ?></h1>
            <p>Date : <?php echo $spectacle['date']; ?></p>
            <p>Prix unitaire : <?php echo $spectacle['prix_eur']; ?> €</p>
            <p>Lieu : <?php echo $spectacle['lieu']; ?></p>

            <form method="post">
                <label for="name">Nom de la personne :</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="qty">Quantité de billets :</label><br>
                <input type="number" id="qty" name="qty" min="1" required><br><br>

                <button type="submit">Réserver</button>
            </form>

            <p><a href="/spectacles">Retour à la liste</a></p>
        <?php endif; ?>
    </body>
</html>
