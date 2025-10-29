# AuthSite - Site de réservation de spectacles# AuthSite - Site de réservation de spectacles# AuthSite - Site de réservation de spectacles



## 📁 Structure

## 🚀 Démarrer le projet

```

AuthSite/**Système à 2 tokens :**

├── index.php              # Point d'entrée + routes

├── Router.php             # Routeur- **Access token** (5 min) - vérifié à chaque requête### Installation

├── .htaccess              # Config Apache

├── controllers/           # Logique métier- **Refresh token** (24h) - renouvelle l'access token automatiquement . Cloner le projet dans le dossier web de votre serveur :

├── views/                 # Affichage HTML

└── donnees/spectacles.php # Données   ```bash

```

**Comptes test :**   cd C:\xampp\htdocs

## 🚀 Installation

- `admin` / `admin` (rôle admin)   git clone https://github.com/AkaTFL/AuthSite.git

```bash

cd C:\xampp\htdocs- `user` / `user` (rôle user)   ```

git clone https://github.com/AkaTFL/AuthSite.git

```



Accès : `http://localhost/AuthSite/`**Format token :** `base64(username|expiration|signature)`2. Démarrer Apache



## 🔐 Authentification



**Système à 2 tokens :**## 🎯 Routes3. Accéder au site :

- **Access token** (5 min) - vérifié à chaque requête

- **Refresh token** (24h) - renouvelle l'access token automatiquement   ```



**Comptes test :**| URL | Auth | Description |   http://localhost/AuthSite/

- `admin` / `admin` (rôle admin)

- `user` / `user` (rôle user)|-----|------|-------------|   ```



**Format token :** `base64(username|expiration|signature)`| `/` | - | Accueil |



## 🎯 Routes| `/spectacles` | - | Liste |### URLs disponibles



| URL | Auth | Description || `/spectacles/details?spectacle_id=X` | - | Détails |- `/` - Accueil

|-----|------|-------------|

| `/` | - | Accueil || `/login` | - | Connexion |- `/spectacles` - Liste des spectacles

| `/spectacles` | - | Liste |

| `/spectacles/details?spectacle_id=X` | - | Détails || `/logout` | - | Déconnexion |- `/reserver?spectacle_id=X` - Réserver (connexion requise)

| `/login` | - | Connexion |

| `/logout` | - | Déconnexion || `/reserver?spectacle_id=X` | ✓ | Réserver |- `/profil` - Mes réservations (connexion requise)

| `/reserver?spectacle_id=X` | ✓ | Réserver |

| `/profil` | ✓ | Mes réservations || `/profil` | ✓ | Mes réservations |- `/admin` - Ajouter un spectacle (connexion requise ainsi que role admin)

| `/admin` | Admin | Ajouter spectacle |

| `/admin` | Admin | Ajouter spectacle |

## ⚙️ Fonctionnement

## 🎯 Routes et contrôleurs

`.htaccess` → `index.php` → `Router` → `Controller` → `View`

## ⚙️ Fonctionnement

**Contrôleurs :** Vérifient auth, traitent données, chargent vue  

**Vues :** Affichent HTML  | Route | Méthode | Contrôleur | Auth |

**Tokens :** Stockés en cookies, renouvelés auto

`.htaccess` → `index.php` → `Router` → `Controller` → `View`|-------|---------|------------|------|

| `/` | GET | SpectacleController@accueil | - |

**Contrôleurs :** Vérifient auth, traitent données, chargent vue  | `/spectacles` | GET | SpectacleController@liste | - |

**Vues :** Affichent HTML  | `/spectacles/details` | GET | SpectacleController@details | - |

**Tokens :** Stockés en cookies, renouvelés auto| `/reserver` | GET/POST | ReservationController | ✓ |

| `/profil` | GET | ProfilController@index | ✓ |
| `/admin` | GET/POST | SpectacleController | Admin |

## � Fonctionnement

**Routeur :** `.htaccess` redirige tout vers `index.php` → `Router.php` analyse l'URL → appelle le bon contrôleur

**Contrôleurs :** Vérifient l'authentification, récupèrent les données et chargent la vue

**Vues :** Affichent le HTML avec les données reçues
