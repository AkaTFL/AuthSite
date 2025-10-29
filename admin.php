<?php
    session_start();

    if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
        header('Location: login.php');
        exit;
    }

    $msg = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $spectacles = include 'donnees/spectacles.php';
        
        $maxId = 0;
        foreach ($spectacles as $s) {
            if ($s['id'] > $maxId) $maxId = $s['id'];
        }
        
        $spectacles[] = [
            'id' => $maxId + 1,
            'nom' => $_POST['nom'],
            'lieu' => $_POST['lieu'],
            'prix_eur' => (float)$_POST['prix_eur'],
            'date' => $_POST['date']
        ];
        
        file_put_contents('donnees/spectacles.php', "<?php\nreturn " . var_export($spectacles, true) . ";\n");
        $msg = 'Spectacle ajouté !';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
    <h1>Ajouter un spectacle</h1>
    
    <?php if ($msg) echo "<p><strong>$msg</strong></p>"; ?>
    
    <form method="post">
        <label>Nom :<br><input type="text" name="nom" required></label><br><br>
        <label>Lieu :<br><input type="text" name="lieu" required></label><br><br>
        <label>Prix (€) :<br><input type="number" name="prix_eur" step="0.01" required></label><br><br>
        <label>Date :<br><input type="date" name="date" required></label><br><br>
        <button type="submit">Ajouter</button>
    </form>
    
    <p><a href="accueil.php">Accueil</a> | <a href="liste_spectacle.php">Liste</a></p>
</body>
</html>