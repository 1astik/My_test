<?php

require "../db.php";

$id = $_GET['id'];

mysql_select_db("prof_br", $db);

    
$strSQL = "SELECT fio,id,osn_h,doljnost,step,kafedra,dr FROM spisok WHERE number = '$id' ";     // запрос
$rs = mysql_query($strSQL, $db);
$row = mysql_fetch_array($rs);

if ( isset($_POST['save']) )
{
	try{
	$fio = strip_tags(trim($_POST['fio']));
	$id = strip_tags(trim($_POST['id']));
	$osn_h = strip_tags(trim($_POST['osn_h']));
	$doljnost = strip_tags(trim($_POST['doljnost']));
	$step = strip_tags(trim($_POST['step']));
	$kafedra = strip_tags(trim($_POST['kafedra']));
	$dr = strip_tags(trim(date('Y-m-d', strtotime($_POST['dr']))));
	
	$strSAVE = "UPDATE spisok SET fio = '$fio',id = '$id',osn_h = '$osn_h',doljnost = '$doljnost',step = '$step',kafedra = '$kafedra',dr = '$dr' WHERE id = '$id' ";
	$rs = mysql_query($strSAVE, $db);
	}
	catch(Exception $ex)
	{
		$msg = $ex->getMessage();
	    echo $msg;
	}
	
    $rs1 = mysql_query($strSQL, $db);
    $row = mysql_fetch_array($rs1);
	
	
	echo "All OK!";
	echo "<a href = '../spisok.php'>Back</a>";
}


?>


<form method = "POST">

<link href="/style/style_remake.css" rel="stylesheet">

<a>ФИО</a>   <div><input type = "text" size = "30" name = "fio" value = "<?php echo $row['fio']; ?>" /></div>

<a>Ид.номер</a>   <div><input type = "text" size = "30" name = "id" value = "<?php echo $row['id']; ?>" /></div>

 <a>Основ. для работы</a>   <div><input type = "text" size = "30" name = "osn_h" value = "<?php echo $row['osn_h']; ?>" /></div>

<a>Должность</a> <div><input type = "text" size = "30" name = "doljnost" value = "<?php echo $row['doljnost']; ?>" /></div>

<a>Научная степень</a>   <div><input type = "text" size = "30" name = "step" value = "<?php echo $row['step']; ?>" /></div>

<a>Кафедра</a>   <div><input type = "text" size = "30" name = "kafedra" value = "<?php echo $row['kafedra']; ?>" /></div>

<a>День рождения</a>  <div><input type = "text" size = "30" name = "dr" value = "<?php echo date_create($row['dr'])->format('d.m.Y'); ?>" /></div>

<div><input type = "submit" name = "save" value = "Сохранить" /></div>


</form>
