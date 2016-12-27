<?php

if($_SERVER["REQUEST_METHOD"] == "GET") {

    mysql_connect("localhost", "root", "") or die (mysql_error());
    mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

    $IdExpediere = mysql_real_escape_string($_GET['IdExpediere']);

    $query = mysql_query("
        DELETE FROM expediere
        WHERE IdExpediere = '$IdExpediere'
        ");

    Print '<script>window.location.assign("admin.php");</script>'; 
 }

 ?>