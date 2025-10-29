<?php
    session_start();

    // Vérification de l'authentification et du rôle admin
    if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
        header('Location: login.php');
        exit;
    }

    // Charger les spectacles existants
    $spectacles = include 'donnees/spectacles.php';
    $message = '';
    $success = false;

    // Traitement du formulaire d'ajout
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = trim($_POST['nom'] ?? '');
        $lieu = trim($_POST['lieu'] ?? '');
        $prix_eur = floatval($_POST['prix_eur'] ?? 0);
        $date = trim($_POST['date'] ?? '');

        // Validation
        if (empty($nom) || empty($lieu) || $prix_eur <= 0 || empty($date)) {
            $message = "❌ Tous les champs sont obligatoires et le prix doit être supérieur à 0.";
        } else {
            // Calculer le prochain ID
            $maxId = 0;
            foreach ($spectacles as $s) {
                if ($s['id'] > $maxId) {
                    $maxId = $s['id'];
                }
            }
            $nouvelId = $maxId + 1;

            // Créer le nouveau spectacle
            $nouveauSpectacle = [
                'id' => $nouvelId,
                'nom' => $nom,
                'lieu' => $lieu,
                'prix_eur' => $prix_eur,
                'date' => $date
            ];

            // Initialiser le tableau de spectacles en session s'il n'existe pas
            if (!isset($_SESSION['spectacles_ajoutes'])) {
                $_SESSION['spectacles_ajoutes'] = [];
            }

            // Ajouter le spectacle en session
            $_SESSION['spectacles_ajoutes'][] = $nouveauSpectacle;

            $success = true;
            $message = "✅ Spectacle ajouté avec succès ! (ID: {$nouvelId})";
            
            // Recharger les spectacles pour inclure les nouveaux
            $spectacles = include 'donnees/spectacles.php';
            if (isset($_SESSION['spectacles_ajoutes'])) {
                $spectacles = array_merge($spectacles, $_SESSION['spectacles_ajoutes']);
            }
        }
    } else {
        // Charger les spectacles avec ceux ajoutés en session
        if (isset($_SESSION['spectacles_ajoutes'])) {
            $spectacles = array_merge($spectacles, $_SESSION['spectacles_ajoutes']);
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Administration - Ajouter un spectacle</title>
</head>
<body>
    <h1>Administration des spectacles</h1>
    
    <p>Connecté en tant que : <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong> (Admin)</p>
    
    <hr>
    
    <h2>Ajouter un nouveau spectacle</h2>
    
    <?php if (!empty($message)): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>
    
    <form method="post">
        <label for="nom">Nom du spectacle :</label><br>
        <input type="text" id="nom" name="nom" required size="50"><br><br>
        
        <label for="lieu">Lieu (format: Salle, adresse, ville) :</label><br>
        <input type="text" id="lieu" name="lieu" required size="50" placeholder="Théâtre du Solstice, 42 rue Victor Hugo, Paris"><br><br>
        
        <label for="prix_eur">Prix (en €) :</label><br>
        <input type="number" id="prix_eur" name="prix_eur" step="0.01" min="0.01" required><br><br>
        
        <label for="date">Date (YYYY-MM-DD) :</label><br>
        <input type="date" id="date" name="date" required><br><br>
        
        <button type="submit">Ajouter le spectacle</button>
    </form>
    
    <hr>
    
    <h2>Liste des spectacles (<?php echo count($spectacles); ?>)</h2>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Lieu</th>
            <th>Prix</th>
            <th>Date</th>
        </tr>
        <?php foreach ($spectacles as $s): ?>
            <tr>
                <td><?php echo htmlspecialchars($s['id']); ?></td>
                <td><?php echo htmlspecialchars($s['nom']); ?></td>
                <td><?php echo htmlspecialchars($s['lieu']); ?></td>
                <td><?php echo htmlspecialchars($s['prix_eur']); ?> €</td>
                <td><?php echo htmlspecialchars($s['date']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <br>
    <p>
        <a href="accueil.php">← Retour à l'accueil</a> | 
        <a href="liste_spectacle.php">Liste des spectacles</a> |
        <a href="profil.php">Mon profil</a>
    </p>
</body>
</html>
