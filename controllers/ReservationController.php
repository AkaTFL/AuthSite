<?php
    class ReservationController {
        
        public function form() {
            if (!isset($_SESSION['user'])) {
                header('Location: /AuthSite/login');
                exit;
            }

            $spectacles = include 'donnees/spectacles.php';

            $spectacle = null;
            if (!empty($_GET['spectacle_id'])) {
                $spectacle_id = (int)$_GET['spectacle_id'];
                
                foreach ($spectacles as $s) {
                    if ($s['id'] == $spectacle_id) {
                        $spectacle = $s;
                        break;
                    }
                }
                
                if ($spectacle === null) {
                    echo "Spectacle non trouvé.";
                    exit;
                }
            } else {
                echo "Aucun spectacle sélectionné.";
                exit;
            }
            
            require 'views/reserver.php';
        }
        
        public function reserver() {
            if (!isset($_SESSION['user'])) {
                header('Location: /AuthSite/login');
                exit;
            }

            $spectacles = include 'donnees/spectacles.php';

            $spectacle = null;
            if (!empty($_GET['spectacle_id'])) {
                $spectacle_id = (int)$_GET['spectacle_id'];
                
                foreach ($spectacles as $s) {
                    if ($s['id'] == $spectacle_id) {
                        $spectacle = $s;
                        break;
                    }
                }
            }

            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 0;
            
            if (!isset($_SESSION['reservations']) || !is_array($_SESSION['reservations'])) {
                $_SESSION['reservations'] = [];
            }

            $_SESSION['reservations'][] = [
                'id' => $spectacle['id'],
                'title' => $spectacle['nom'],
                'date' => $spectacle['date'],
                'price' => $spectacle['prix_eur'],
                'name' => $name,
                'qty' => $qty,
                'reserved_at' => date('c'),
            ];

            $success = true;
            
            require 'views/reserver.php';
        }
    }
?>