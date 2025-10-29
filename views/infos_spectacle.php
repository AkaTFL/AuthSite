<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Informations spectacle</title>
</head>
<body>
    <?php if ($spectacle_trouve === null): ?>
        <p>Aucun spectacle spécifié ou spectacle non trouvé.</p>
    <?php else: ?>
        <h1>Informations du spectacle</h1>
        <p><strong>ID :</strong> <?php echo $spectacle_trouve['id']; ?></p>
        <p><strong>Nom :</strong> <?php echo $spectacle_trouve['nom']; ?></p>
        <p><strong>Lieu :</strong> <?php echo $spectacle_trouve['lieu']; ?></p>
        <p><strong>Prix :</strong> <?php echo $spectacle_trouve['prix_eur']; ?> €</p>
        <p><strong>Date :</strong> <?php echo $spectacle_trouve['date']; ?></p>
        
    <br>
    <a href="/AuthSite/reserver?spectacle_id=<?php echo $spectacle_trouve['id']; ?>">Réserver ce spectacle</a>
    |
    <a href="/AuthSite/spectacles">Retour à la liste</a>
    <?php endif; ?>
</body>
</html>
