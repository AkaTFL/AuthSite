<?php
    session_start();

    $spectacles = include 'spectacles.php';

    if (!empty($_GET['spectacle_id'])) {
        $spectacle = ['id' => $_GET['spectacle_id']];
    } else {
        echo "Aucun spectacle sélectionné.";
        redirect('liste_spectacle.php');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_GET['spectacle_id']);

        foreach ($spectacles as $s) {
            if ($s['id'] == $id) {
                $title = $s['nom'];
                $date = $s['date'];
                $price = $s['prix_eur'];
                $name = $_POST['name'];
                $qty = $_POST['qty'];
                break;
            }
        }    
        
        if (!isset($_SESSION['reservations']) || !is_array($_SESSION['reservations'])) {
            $_SESSION['reservations'] = [];
        }

        $_SESSION['reservations'][] = [
            'id' => $id,
            'title' => $title,
            'date' => $date,
            'price' => $price,
            'name' => $name,
            'qty' => $qty,
            'reserved_at' => date('c'),
        ];

        echo "<p>✅ Réservation enregistrée pour <strong>{$spectacle['nom']}</strong> ({$qty} billet(s)).</p>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Réservation - <? ($spectacle['nom']) ?></title>
    </head>
    <body>
        <h1>Réserver : <? $spectacle['nom'] ?></h1>
        <p>Date : <? ($spectacle['date']) ?></p>
        <p>Prix unitaire : <? ($spectacle['prix_eur']) ?> €</p>
        <p>Lieu : <? ($spectacle['lieu']) ?></p>

        <form method="post">
            <label for="name">Nom de la personne :</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="qty">Quantité de billets :</label><br>
            <input type="number" id="qty" name="qty" min="1" required><br><br>

            <button type="submit">Réserver</button>
        </form>

        <p><a href="liste_spectacle.php">← Retour à la liste</a></p>
    </body>
</html>