<?php
if (isset($_GET['logout']) && $_GET['logout'] ) {
    $controller->logout();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Personalwerk StudyCase</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
		
		<link href="css/style.css" rel="stylesheet">
        
        <script type='text/javascript' src='js/jquery-2.2.1.min.js'></script>
        <script src="https://tinymce.cachefly.net/4.3/tinymce.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
		

		<script type='text/javascript' src='js/validator.js'></script>
         
    </head>
    <body>