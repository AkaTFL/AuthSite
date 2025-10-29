Il existe 3 facteur d'authentification : le facteur de connaisance, le facteur de possession et le facteur d'inhérence.

Le facteur de connaissance repose sur quelque chose que l'utilisateur sait, comme un mot de passe ou un code PIN.

Le facteur de possession, quand à lui, est plutot orienté sur quelque chose que l'utilisateur possède, comme un lien magique, un code par mail, etc.

Enfin, le facteur d'inhérence est plutot orientée sur les données biométriques de l'utilisateur, comme une empreinte digitale, une reconnaissance faciale, etc.

On veut un site de spectacles.
Les cas d'utilisation sont :
<!-- - Pages d'accueil (publique) -->
<!-- - Page de la liste des spectacles (publique) -->
<!-- - Page de fiche des spectacles (publique) -->
<!-- - Réservation de places (authentification requise) -->
<!-- - Accéder à son profils : liste des billets que j'ai reservé (authentification requise) page à faire -->
- Ajouter des spectacles (authentification requise + rôle admin) page à faire

Concernant les données, il n'y a pas d'obligations d'avoir une BDD

Contraintes:
-Routeur
-Controleur->Méthodes qui résolvent chaque cas d'utilisation

En option-> Implémenter le middleware sous forme d'attribut PHP