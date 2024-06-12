<?php
require_once('functions.php');
$user = null;

session_start();
$userSession = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if(isset($_GET['id']) && isset($userSession) && $userSession->id == $_GET['id']) {
    $users = getUser($_GET['id']);
    if(!empty($users)) {
        $user = $users[0];
    }
}
?>

<?php if($user): ?>
<h1>Information de l'utilisateur <?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></h1>
<table>
    <tr>
        <td>id</td>
        <td><?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <td>username</td>
        <td><?= htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <td>email</td>
        <td><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
</table>
<?php else: ?>
    L'utilisateur recherché n'existe pas
<?php endif; ?>
<br/>
<br/>
<a href="index.php">Accueil</a>
