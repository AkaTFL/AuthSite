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
        <label>Lieu :<input type="text" name="lieu" required></label><br><br>
        <label>Prix (€) :<input type="number" name="prix_eur" required></label><br><br>
        <label>Date :<input type="date" name="date" required></label><br><br>
        <button type="submit">Ajouter</button>
    </form>
    
    <p><a href="/AuthSite/">Accueil</a> | <a href="/AuthSite/spectacles">Liste</a></p>
</body>
</html>
