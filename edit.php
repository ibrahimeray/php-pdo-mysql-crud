<?php
include 'class/content.php';
$controller = new Content();
include 'includes/header.php';
if (!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
    $controller->redirect('index.php');
}
if (isset($_GET['jobs_id'])) {
    $jobdetails = $controller->get_edit($_SESSION['user_id'], $_GET['jobs_id']);
}

if (isset($_POST['edit_save'])) {

    $timestamp = time();
    $titel = trim($_POST['titel']);
    $beschreibung = trim($_POST['beschreibung']);
    $now = time();
    $erstellungsdatum = date("Y-m-d", $now);

    if ($controller->save_edit($titel, $beschreibung, $erstellungsdatum, $_SESSION['user_id'], $_GET['jobs_id'])) {
        $controller->redirect('dashboard.php');
    } else {
        $error = "Unbekannte Fehler! Bitte versuchen Sie sich später noch ein Mal!";
    }
}
?>

<div class="header-top"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 header-text">
            <h1>Stellenbörse </h1>
            <span>Verwaltung</span>
        </div>
        <div class="col-lg-10 header-login-btn">
            <a href="<?= $_SERVER['PHP_SELF'] ?>?logout=true" class="btn-link btn-img logout">Logout</a>
        </div>
    </div>
</div>

<div class="container-pages">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="error">
                    <center><?php if (isset($error)) {
                            echo $error;
                        } ?></center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3><b>Bearbeiten: <span> <?= $jobdetails['titel'] ?> </span></b></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="titel">Titel:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="titel" name="titel" placeholder="Titel eingeben"
                                   value="<?= $jobdetails['titel'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="beschreibung">Text:</label>
                        <div class="col-sm-10">
                            <textarea id="beschreibung" class="mceEditor" name="beschreibung" rows="15"
                                      required><?= $jobdetails['beschreibung'] ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 text-right bold">
                            <button type="submit" class="btn-link btn-img speichern bold" name="edit_save">Speichern
                            </button>
                            <a href="dashboard.php" class="btn-link btn-img abbrechen bold">Abbrechen</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
