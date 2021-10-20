<?php
$mysql_hostname = "sql207.epizy.com";
$mysql_user = "epiz_29476778";
$mysql_password = "4kkRkD7gMY";
$mysql_database = "epiz_29476778_secure";

$db = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("db connect error");
?>