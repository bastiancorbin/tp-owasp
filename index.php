<?php
require_once('functions.php');
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if (isset($_POST['email']) && isset($_POST['password'])) {
    $userDb = logUser($_POST['email'], $_POST['password']);
    if($userDb) {
        $user = $userDb;
        $_SESSION['user'] = $user;
    }
}
?>

<html>
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ma super app sécurisée</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
              integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu"
              crossorigin="anonymous">
        <script src="https://www.google.com/recaptcha/enterprise.js?render=6LfsJfcpAAAAAGZe3MJIa9LFAEu9rZ07pVc20X87"></script>
    </head>
</head>
<body>
<div class="container">
    <?php if(!$user): ?>
    <h1>Connexion</h1>
    <form action="/tp-owasp/" method="POST" id="demo-form">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="stayConnected">Rester connecté</label>
            <input name="stayConnected" type="checkbox" id="stayConnected">
        </div>
        <button class="g-recaptcha"
            data-sitekey="6LfsJfcpAAAAAGZe3MJIa9LFAEu9rZ07pVc20X87"
            data-callback='onSubmit'
            data-action='submit'>Submit</button>

        <a href="https://accounts.google.com/o/oauth2/v2/auth?scope=email&response_type=code&access_type=online&redirect_uri=<?= urlencode('http://localhost/tp-owasp/index.php') ?>&client_id=941091354895-4g48le879ki76ktahcdmv8cnu05cjm3q.apps.googleusercontent.com">Google</form>
    <a href="register.php">Je m'inscrit</a>
    <?php else: ?>
        <h1>Bienvenue <?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></h1>
    <a href="informations.php?id=<?= $user->id ?>">Mes informations</a><br/>
    <a href="logout.php">Logout</a>
    <?php endif ?>
</div>
</body>

<script>
  function onSubmit(token) {
    document.getElementById("demo-form").submit();
  }
</script>
</html>