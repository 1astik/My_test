<?php

$id = $_GET['id'];

mysql_select_db("prof_br", $db);
$strSQL = "DELETE FROM spisok WHERE number = '$id'";     // ������
$rs = mysql_query($strSQL, $db);
mysql_close();






?>

