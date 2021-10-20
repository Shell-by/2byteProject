<?php
    $DBHost = "sql207.epizy.com";
	$DBUser = "epiz_29476778";
	$DBPass = "4kkRkD7gMY";
	$DBName = "epiz_29476778_secure";

	$conn = mysql_connect($DBHost, $DBUser, $DBPass);
	$xx = mysql_select_db($DBName, $conn) or die("DB 선택 에러");
	mysql_query("set names $DBChar");
?>