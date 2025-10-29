# AuthSite — mini app de réservation

Projet simple : liste de spectacles, réservation en session, admin pour ajouter un spectacle, authentification minimale (access + refresh tokens).


## Routes principales
- / → accueil
- /spectacles → liste
- /spectacles/details?spectacle_id=ID → détails
- /reserver?spectacle_id=ID → réserver (GET/POST)
- /profil → voir ses réservations (auth requise)
- /admin → ajouter spectacle (admin requise)
- /login, /logout → authentification

## Comptes de test
- admin / admin  (rôle : admin)  
- user  / user   (rôle : user)

## Notes rapides
- Les réservations sont stockées en session ($_SESSION['reservations']).
- Les spectacles sont sauvegardés dans `donnees/spectacles.php`.
- `.htaccess` redirige tout vers `index.php` pour le routeur (Apache).

C'est tout — lancer le serveur et tester les routes.