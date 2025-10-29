<?php
    function b64($s){ return rtrim(strtr(base64_encode($s), '+/','-_'),'='); }

    function create_jwt($payload, $secret){
        $h = b64(json_encode(['alg'=>'HS256','typ'=>'JWT']));
        $p = b64(json_encode($payload));
        $sig = b64(hash_hmac('sha256', "$h.$p", $secret, true));
        return "$h.$p.$sig";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $u = trim($_POST['username'] ?? '');
        $pw = $_POST['password'] ?? '';

        if ($u === '' || $pw === '') {
            $msg = 'Remplir tous les champs.';
        } else {
            $pw_hash = password_hash($pw, PASSWORD_DEFAULT);
            $payload = ['sub' => $u, 'pwd_hash' => $pw_hash, 'iat' => time(), 'exp' => time() + 3600];
            $jwt = create_jwt($payload);
            setcookie(
                $name ='token', 
                $jwt, 
                $time = time() + 3600,
            );

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
