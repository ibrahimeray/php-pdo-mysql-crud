<?php
include 'class/content.php';
$controller = new Content();
include 'includes/header.php';

$result  = $controller->get_allejobs();
?>

<div class="header-top"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 header-text">
            <h1>Stellenbörse </h1>
            <span>Stellenliste</span>
        </div>
    </div>
</div>

<div class="container-fluid no-padding-right no-padding-left" >
    <div class="accordion">
        <?php
	 
		 
        $i = 0;
        foreach ($result as $value) { ?>
            <div class="accordion-section">
                <div class="accordion-background">
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
    <?php $i++; } ?>
    </div>
</div>	

<?php include 'includes/footer.php'; ?>
