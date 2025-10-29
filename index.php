<?php
session_start();

require_once 'Router.php';
require_once 'controllers/SpectacleController.php';
require_once 'controllers/ReservationController.php';
require_once 'controllers/ProfilController.php';

$router = new Router();

// Routes publiques
$router->get('/', 'SpectacleController@accueil');
$router->get('/spectacles', 'SpectacleController@liste');
$router->get('/spectacles/details', 'SpectacleController@details');

// Routes de réservation (authentification requise)
$router->get('/reserver', 'ReservationController@form');
$router->post('/reserver', 'ReservationController@reserver');

// Route profil (authentification requise)
$router->get('/profil', 'ProfilController@index');

// Routes admin (authentification + rôle admin requis)
$router->get('/admin', 'SpectacleController@ajoutForm');
$router->post('/admin', 'SpectacleController@ajouter');

// Résoudre la route
$router->resolve();
