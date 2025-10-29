<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mon profil</title>
</head>
<body>
    <h1>Mon profil</h1>
    
    <p>Bienvenue, <strong><?php echo ($_SESSION['user']); ?></strong> !</p>
    
    <hr>
    
    <h2>Mes réservations</h2>
    
    <?php
    if (!isset($_SESSION['reservations']) || empty($_SESSION['reservations'])) {
        echo "<p>Vous n'avez effectué aucune réservation pour le moment.</p>";
    } else {
        echo "<p>Vous avez " . count($_SESSION['reservations']) . " réservation(s) :</p>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>";
        echo "<th>Spectacle</th>";
        echo "<th>Date</th>";
        echo "<th>Prix unitaire</th>";
        echo "<th>Nom</th>";
        echo "<th>Quantité</th>";
        echo "<th>Total</th>";
        echo "<th>Réservé le</th>";
        echo "</tr>";
        
        foreach ($_SESSION['reservations'] as $reservation) {
            $total = $reservation['price'] * $reservation['qty'];
            echo "<tr>";
            echo "<td>" . ($reservation['title']) . "</td>";
            echo "<td>" . ($reservation['date']) . "</td>";
            echo "<td>" . ($reservation['price']) . " €</td>";
            echo "<td>" . ($reservation['name']) . "</td>";
            echo "<td>" . ($reservation['qty']) . "</td>";
            echo "<td>" . ($total) . " €</td>";
            echo "<td>" . (date('d/m/Y H:i', strtotime($reservation['reserved_at']))) . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
    ?>
    
    <br>
    <p>
        <a href="/">Retour à l'accueil</a> | <a href="/spectacles">Liste des spectacles</a>
    </p>
</body>
</html>
