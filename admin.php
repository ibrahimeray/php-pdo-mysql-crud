<?php
include 'class/content.php';
$controller = new Content();
include 'includes/header.php';

if (isset($_POST['login'])) {
    $benutzername = trim($_POST['benutzername']);
    $password = trim($_POST['password']);
    if ($controller->login($benutzername, $password)) {
        $controller->redirect('dashboard.php');
    } else {
        $error = "Die Login-Daten sind nicht korrekt.";
    }
}
?>

<div class="header-login container-pages">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-lg-offset-5 header-text">
                <h1>Stellenbörse</h1>
                <span>Verwaltung</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-lg-offset-5">
                <?php if (isset($error)) { ?>
                    <div class="error"><?= $error ?></div>
                <?php } ?>
                <form method="post" class="form-signin" id="einloggen">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Benutzername" id="benutzername"
                               name="benutzername" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password"
                               required>
                    </div>
                    <a href="register.php" class="btn-link pull-left">Neu Kunde?</a>
                    <button type="submit" class="pull-right btn-login" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
