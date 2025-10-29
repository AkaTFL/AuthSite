<?php
class ProfilController {
    
    public function index() {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
        
        require 'views/profil.php';
    }
}
