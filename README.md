# AuthSite - Architecture MVC avec Routeur

## 📁 Nouvelle structure du projet

```
AuthSite/
├── index.php                          # Point d'entrée unique
├── Router.php                         # Classe routeur
├── .htaccess                          # Configuration Apache
├── controllers/                       # Contrôleurs (logique métier)
│   ├── SpectacleController.php
│   ├── ReservationController.php
│   └── ProfilController.php
├── views/                             # Vues (HTML/affichage)
│   ├── accueil.php
│   ├── liste_spectacle.php
│   ├── infos_spectacle.php
│   ├── reserver.php
│   ├── profil.php
│   └── admin.php
├── donnees/
│   └── spectacles.php                 # Données des spectacles
└── [anciens fichiers]                 # À supprimer ou archiver
```

## 🎯 Cas d'utilisation et leurs routes

| Cas d'utilisation | Méthode | Route | Contrôleur | Authentification |
|-------------------|---------|-------|------------|------------------|
| Page d'accueil | GET | `/` | SpectacleController@accueil | Non |
| Liste des spectacles | GET | `/spectacles` | SpectacleController@liste | Non |
| Détails d'un spectacle | GET | `/spectacles/details?spectacle_id=X` | SpectacleController@details | Non |
| Formulaire de réservation | GET | `/reserver?spectacle_id=X` | ReservationController@form | Oui |
| Enregistrer une réservation | POST | `/reserver?spectacle_id=X` | ReservationController@reserver | Oui |
| Page profil | GET | `/profil` | ProfilController@index | Oui |
| Formulaire d'ajout spectacle | GET | `/admin` | SpectacleController@ajoutForm | Oui (Admin) |
| Ajouter un spectacle | POST | `/admin` | SpectacleController@ajouter | Oui (Admin) |

## 🚀 Fonctionnement

### Routeur (`Router.php`)
- Intercepte toutes les requêtes via `.htaccess`
- Analyse la méthode HTTP (GET/POST) et le chemin
- Appelle le bon contrôleur avec la bonne méthode

### Contrôleurs
Chaque contrôleur contient des méthodes qui :
1. Vérifient l'authentification si nécessaire
2. Récupèrent/traitent les données
3. Chargent la vue correspondante

### Vues
Fichiers HTML/PHP purs qui :
- Reçoivent les données des contrôleurs
- Affichent le contenu
- Ne contiennent pas de logique métier

## 🔄 Migration depuis l'ancienne structure

### Ancienne structure
```php
// accueil.php - tout dans un seul fichier
<?php session_start(); ?>
<html>...</html>
```

### Nouvelle structure
```php
// index.php - routeur
$router->get('/', 'SpectacleController@accueil');

// controllers/SpectacleController.php - logique
public function accueil() {
    require 'views/accueil.php';
}

// views/accueil.php - affichage
<html>...</html>
```

## ✅ Avantages

- ✅ Respect des contraintes du cours (Routeur + Contrôleurs)
- ✅ Séparation des responsabilités (logique ≠ affichage)
- ✅ URLs propres : `/spectacles` au lieu de `liste_spectacle.php`
- ✅ Code plus maintenable et organisé
- ✅ Une méthode = un cas d'utilisation
- ✅ Logique inchangée, juste réorganisée

## 📝 Accéder à l'application

**Développement local :**
```
http://localhost/AuthSite/
http://localhost/AuthSite/spectacles
http://localhost/AuthSite/profil
```

**Important :** Si `.htaccess` ne fonctionne pas, vérifier que `mod_rewrite` est activé dans Apache.
