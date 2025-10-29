<?php
class AuthController {
    
    private const SECRET = 'secret123';
    private const ACCESS_TTL = 300;      // 5 minutes
    private const REFRESH_TTL = 86400;   // 24 heures
    
    private function makeToken($username, $ttl) {
        $exp = time() + $ttl;
        $data = "$username|$exp";
        $sig = hash_hmac('sha256', $data, self::SECRET);
        return base64_encode("$data|$sig");
    }
    
    private function verifyToken($token) {
        $decoded = base64_decode($token);
        $parts = explode('|', $decoded);
        
        if (count($parts) !== 3) return null;
        
        [$username, $exp, $sig] = $parts;
        
        $expectedSig = hash_hmac('sha256', "$username|$exp", self::SECRET);
        if (!hash_equals($expectedSig, $sig)) return null;
        
        if (time() > $exp) return null;
        
        return ['username' => $username, 'exp' => $exp];
    }
    
    public function loginForm() {
        $error = '';
        require 'views/login.php';
    }
    
    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if ($username === '' || $password === '') {
            $error = 'Tous les champs sont requis.';
            require 'views/login.php';
            return;
        }
        
        $role = null;
        if ($username === 'admin' && $password === 'admin') {
            $role = 'admin';
        } elseif ($username === 'user' && $password === 'user') {
            $role = 'user';
        }
        
        if ($role === null) {
            $error = 'Identifiants incorrects.';
            require 'views/login.php';
            return;
        }
        
        $accessToken = $this->makeToken($username, self::ACCESS_TTL);
        $refreshToken = $this->makeToken($username, self::REFRESH_TTL);
        
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $role;
        
        setcookie('access_token', $accessToken, time() + self::ACCESS_TTL, '/', '', false, true);
        setcookie('refresh_token', $refreshToken, time() + self::REFRESH_TTL, '/', '', false, true);
        
        header('Location: /');
        exit;
    }
    
    public function checkAuth() {
        if (isset($_COOKIE['access_token'])) {
            $data = $this->verifyToken($_COOKIE['access_token']);
            if ($data) {
                $_SESSION['user'] = $data['username'];
                return true;
            }
        }
        
        if (isset($_COOKIE['refresh_token'])) {
            $data = $this->verifyToken($_COOKIE['refresh_token']);
            if ($data) {
                $newAccessToken = $this->makeToken($data['username'], self::ACCESS_TTL);
                setcookie('access_token', $newAccessToken, time() + self::ACCESS_TTL, '/', '', false, true);
                
                $_SESSION['user'] = $data['username'];
                return true;
            }
        }
        
        return false;
    }
    
    public function logout() {
        session_destroy();
        setcookie('access_token', '', time() - 3600, '/');
        setcookie('refresh_token', '', time() - 3600, '/');
        header('Location: /');
        exit;
    }
}
