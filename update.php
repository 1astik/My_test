<?php
$db = mysql_connect('localhost', 'root', '');
mysql_select_db("prof_br", $db);

	$id = $_POST['number'];
	$fio = trim($_POST['mas'][0]);
	$inn = trim($_POST['mas'][1]);
	$osn_h = trim($_POST['mas'][2]);
	$doljnost = trim($_POST['mas'][3]);
	$step = trim($_POST['mas'][4]);
	$kafedra = trim($_POST['mas'][5]);
	//$dr = trim(date('Y-m-d', strtotime($_POST['dr']))));
	
	if ($id != "")
	{
		$strSAVE = "UPDATE spisok SET fio = '$fio',id = '$inn',osn_h = '$osn_h',doljnost = '$doljnost',step = '$step',kafedra = '$kafedra' WHERE number = '$id' ";
	}else {
		$strSAVE = "INSERT INTO spisok (`fio`,`id`,`osn_h`, `doljnost`, `step`, `kafedra`) VALUES ('$fio', '$inn', '$osn_h', '$doljnost', '$step', '$kafedra')";
	}
	    
	mysql_query($strSAVE);
    mysql_close();

?>