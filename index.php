<?php
session_start();

require_once 'Router.php';
require_once 'controllers/SpectacleController.php';
require_once 'controllers/ReservationController.php';
require_once 'controllers/ProfilController.php';

$router = new Router();

$router->get('/', 'SpectacleController@accueil');
$router->get('/spectacles', 'SpectacleController@liste');
$router->get('/spectacles/details', 'SpectacleController@details');
$router->get('/reserver', 'ReservationController@form');
$router->get('/profil', 'ProfilController@index');
$router->get('/admin', 'SpectacleController@ajoutForm');

$router->post('/reserver', 'ReservationController@reserver');
$router->post('/admin', 'SpectacleController@ajouter');


$router->resolve();
