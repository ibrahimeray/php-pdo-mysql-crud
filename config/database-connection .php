<?php

        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "root";
        $dbName = "personalwerk";

        $connection = mysql_connect($dbHost,$dbUser,$dbPass, $dbName)
            or die("Could not connect to the database:<br />" . mysql_error());
        mysql_select_db($dbName, $connection) 
            or die("Database error:<br />" . mysql_error());
 
 $gast = new Gast($connection);
?>