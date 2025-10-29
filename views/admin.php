<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
    <h1>Ajouter un spectacle</h1>
    
    <?php if (isset($msg) && $msg) echo "<p><strong>$msg</strong></p>"; ?>
    
    <form method="post">
        <label>Nom :<br><input type="text" name="nom" required></label><br><br>
        <label>Lieu :<br><input type="text" name="lieu" required></label><br><br>
        <label>Prix (€) :<br><input type="number" name="prix_eur" step="0.01" required></label><br><br>
        <label>Date :<br><input type="date" name="date" required></label><br><br>
        <button type="submit">Ajouter</button>
    </form>
    
    <p><a href="/">Accueil</a> | <a href="/spectacles">Liste</a></p>
</body>
</html>
