<?php
    session_start();

    // Vérification de l'authentification
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }

    $spectacles = include 'donnees/spectacles.php';

    $spectacle = null;
    if (!empty($_GET['spectacle_id'])) {
        $spectacle_id = (int)$_GET['spectacle_id'];
        
        // Trouver le spectacle correspondant
        foreach ($spectacles as $s) {
            if ($s['id'] == $spectacle_id) {
                $spectacle = $s;
                break;
            }
        }
        
        if ($spectacle === null) {
            echo "Spectacle non trouvé.";
            exit;
        }
    } else {
        echo "Aucun spectacle sélectionné.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 0;
        
        if (!isset($_SESSION['reservations']) || !is_array($_SESSION['reservations'])) {
            $_SESSION['reservations'] = [];
        }

        $_SESSION['reservations'][] = [
            'id' => $spectacle['id'],
            'title' => $spectacle['nom'],
            'date' => $spectacle['date'],
            'price' => $spectacle['prix_eur'],
            'name' => $name,
            'qty' => $qty,
            'reserved_at' => date('c'),
        ];

        $success = true;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Réservation - ($spectacle['nom']); ?></title>
    </head>
    <body>
        <?php 
            if (isset($success) && $success){
                echo '<p>✅ Réservation enregistrée pour <strong>' . ($spectacle['nom']) . '</strong>echo ($qty); ?> billet(s)).</p>
                        <p><a href="profil.php">Voir mes réservations</a></p>
                        <p><a href="liste_spectacle.php">Retour à la liste</a></p>';
            } else {
                echo '<h1>Réserver : ' . ($spectacle['nom']) . '</h1>
                        <p>Date : ' . ($spectacle['date']) . ' </p>
                        <p>Prix unitaire : ' . ($spectacle['prix_eur']) . ' €</p>
                        <p>Lieu : ' . ($spectacle['lieu']) .'</p>';
            }
        ?>

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