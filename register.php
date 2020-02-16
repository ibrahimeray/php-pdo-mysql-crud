<?php
include 'class/content.php';
$controller = new Content();
include 'includes/header.php';

if (isset($_POST['register'])) {
	
    $benutzername   = trim($_POST['benutzername']);
    $password       = trim($_POST['password']);
    $vorname        = trim($_POST['vorname']);
    $nachname       = trim($_POST['nachname']);	
    $geburtsdatum   = trim($_POST['geburtsdatum']);
	
	if ($controller->register($vorname, $nachname, $geburtsdatum, $benutzername, $password)) {
		$controller->redirect('admin.php');
	} else {
		 $error = "Angegebene Benutzername ist  in DB schon Vorhanden!";
	}
}
?>


<div class="header-login container-pages">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-lg-offset-5 header-text">
                <h1>Stellenbörse</h1>
                <span>Register</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-lg-offset-5">
                <?php if (isset($error)) { ?>
                    <div class="error" ><?= $error ?></div>
                <?php } ?>
                <form method="post" class="form-signin" id="register">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Vorname" id="vorname" name="vorname" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nachname" id="nachname" name="nachname" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control geburtsdatum" placeholder="Geb.dat d-m-Y"  id="geburtsdatum" name="geburtsdatum" >
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Benutzername" id="benutzername" name="benutzername" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                    </div>
                    <a href="admin.php" class=" btn-link pull-left">Ich bin Kunde</a>
                    <button class="pull-right btn-login" name="register" type="submit">Registrieren</button> 
                </form>
            </div>
        </div>	
    </div>
</div>

<?php include 'includes/footer.php'; ?>
