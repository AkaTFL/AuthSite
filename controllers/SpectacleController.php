<?php
    class SpectacleController {
        
        public function accueil() {
            require 'views/accueil.php';
        }
        
        public function liste() {
            $spectacles = include 'donnees/spectacles.php';
            require 'views/liste_spectacle.php';
        }
        
        public function details() {
            $spectacle_id = isset($_GET['spectacle_id']) ? (int)$_GET['spectacle_id'] : null;

            if ($spectacle_id === null) {
                $spectacle_trouve = null;
            } else {
                $spectacles = include 'donnees/spectacles.php';
                
                $spectacle_trouve = null;
                foreach ($spectacles as $s) {
                    if ($s['id'] == $spectacle_id) {
                        $spectacle_trouve = $s;
                        break;
                    }
                }
            }
            
            require 'views/infos_spectacle.php';
        }
        
        public function ajoutForm() {
            if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
                header('Location: /AuthSite/login');
                exit;
            }
            
            $msg = '';
            require 'views/admin.php';
        }
        
        public function ajouter() {
            if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
                header('Location: /AuthSite/login');
                exit;
            }
            
            $spectacles = include 'donnees/spectacles.php';
            
            $maxId = 0;
            foreach ($spectacles as $s) {
                if ($s['id'] > $maxId) $maxId = $s['id'];
            }
            
            $spectacles[] = [
                'id' => $maxId + 1,
                'nom' => $_POST['nom'],
                'lieu' => $_POST['lieu'],
                'prix_eur' => (float)$_POST['prix_eur'],
                'date' => $_POST['date']
            ];
            
            file_put_contents('donnees/spectacles.php', "<?php\nreturn " . var_export($spectacles, true) . ";\n");
            
            $msg = 'Spectacle ajouté !';
            require 'views/admin.php';
        }
    }
?>