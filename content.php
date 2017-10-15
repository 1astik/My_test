<?php
$id = $_POST['name'];

$db = mysql_connect('localhost', 'root', '');
mysql_select_db("prof_br", $db);

    
$strSQL5 = "SELECT fio,id,osn_h,doljnost,step,kafedra,dr FROM spisok WHERE number = '$id' ";     // запрос
$rs5 = mysql_query($strSQL5, $db);
$row3 = mysql_fetch_array($rs5);
echo json_encode($row3);
exit();

?>