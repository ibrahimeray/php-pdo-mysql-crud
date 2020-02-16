<?php
include 'class/content.php';
$controller = new Content();
include 'includes/header.php';

if (!isset($_SESSION['user_id']) or $_SESSION['user_id'] == NULL) {
    $controller->redirect('index.php');
}

$joblist = $controller->get_recruiterjobs($_SESSION['user_id']);
if (isset($_GET['loschen']) && $_GET['loschen'] == 1) {
    $joblist = $controller->delete($_GET['jobs_id'], $_SESSION['user_id']);
}
if (isset($_GET['logout']) && $_GET['logout']) {
    $controller->logout();
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

<?php if (empty($joblist)) { ?>
    <div class="well well-lg text-center">
        <h4><b>Sie haben kein Eintrag</b></h4>
    </div>
    <div class="pull-right hinzufugen-text">
        <a href="erstellen.php" class="btn-link btn-img hinzufugen">Hinzufügen</a>
    </div>
<?php } else { ?>
    <div class="container-fluid no-padding-right no-padding-left">
        <div class="accordion">
            <?php
            $i = 0;
            foreach ($joblist as $value) {
                ?>
                <div class="accordion-section">
                    <div class="accordion-background">
                        <div class="pull-right">
                            <a href="edit.php?jobs_id=<?= $value['jobs_id'] ?>" class="btn-link btn-img editieren"></a>
                            <a href="dashboard.php?loschen=1&jobs_id=<?= $value['jobs_id'] ?>"
                               class="btn-link btn-img abbrechen"></a>
                        </div>
                        <span class="text-right">
							<a class="accordion-section-title" href="#joblist-<?= $i ?>">
								<b><?= $value['titel'] ?></b>
							</a>
						</span>
                    </div>
                    <div id="joblist-<?= $i ?>" class="accordion-section-content">
                        <?= $value['beschreibung'] ?>
                    </div>
                </div>
                <?php $i++;
            } ?>
        </div>
        <div class="pull-right hinzufugen-text">
            <a href="erstellen.php" class="btn-link btn-img hinzufugen">Hinzufügen</a>
        </div>
    </div>
<?php } ?>
<?php include 'includes/footer.php'; ?>
