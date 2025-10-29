<?php
    function encrypt($s){ 
        return rtrim(strtr(base64_encode($s), '+/', '-_'), '='); 
    }

    function decrypt($s){ 
        $s=strtr($s,'-_','+/'); 
        return base64_decode(str_pad($s, (4 - strlen($s)%4)%4 + strlen($s), '=', STR_PAD_RIGHT)); 
    }
    
    function make_jwt(array $payload){
        $h = b64u(json_encode(['alg'=>'HS256','typ'=>'JWT']));
        $p = b64u(json_encode($payload));
        $s = b64u(hash_hmac('sha256', "$h.$p", SECRET, true));
        return "$h.$p.$s";
    }

    function verify_jwt(string $jwt){
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) return null;
        [$h,$p,$s] = $parts;
        $sig = b64u(hash_hmac('sha256', "$h.$p", SECRET, true));
        if (!hash_equals($sig, $s)) return null;
        $payload = json_decode(b64u_dec($p), true);
        if (!$payload || (isset($payload['exp']) && time() > $payload['exp'])) return null;
        return $payload;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $u = trim($_POST['username'] ?? '');
        $pw = trim($_POST['password'] ?? '');
        if ($u === '' || $pw === '') {
            $msg = 'Remplir tous les champs.';
        } else {
            $now = time();
            $access  = make_jwt(['sub'=>$u,'iat'=>$now,'exp'=>$now+$ACCESS_TTL]);
            $refresh = make_jwt(['sub'=>$u,'iat'=>$now,'exp'=>$now+$REFRESH_TTL,'typ'=>'refresh']);
            setcookie('token', $access,  $now+$ACCESS_TTL,  '/', '', false, true);
            setcookie(
                $name = 'refresh_token',
                $refresh, 
                $time = $now + 900, '/', '', false, true
            );
            $msg = 'Connecté.';
        }
    } else {
        $accessPayload = isset($_COOKIE['token']) ? verify_jwt($_COOKIE['token']) : null;
        if (!$accessPayload) {
            $refreshPayload = isset($_COOKIE['refresh_token']) ? verify_jwt($_COOKIE['refresh_token']) : null;
            if ($refreshPayload) {
                $now = time();
                $access = make_jwt(['sub'=>$refreshPayload['sub'],'iat'=>$now,'exp'=>$now+$ACCESS_TTL]);
                setcookie('token', $access, $now+3600, '/', '', false, true);
            }
        }
    }
?>

<!doctype html>
<html lang="fr">
    <head>
        <title>Connexion</title>
    </head>
    <body>
        <h2>Connexion</h2>
        <?php if ($msg){
            echo $msg;
        }?>
        <form method="post" action="">
            <label>Nom d'utilisateur<br><input name="username" required></label><br>
            <label>Mot de passe<br><input type="password" name="password" required></label><br>
            <button type="submit">Se connecter</button>
        </form>
    </body>
</html>
