<?php

require "../db.php";

mysql_select_db("prof_br", $db);

    

if ( isset($_POST['create']) )
{
	$number = $_POST['number'];
	$fio = $_POST['fio'];
	$id = $_POST['id'];
	$osn_h = $_POST['osn_h'];
	$doljnost = $_POST['doljnost'];
	$step = $_POST['step'];
	$kafedra = $_POST['kafedra'];
	$dr = $_POST['dr'];
	
	$strCR = "INSERT INTO spisok (`number`, `fio`,`id`,`osn_h`, `doljnost`, `step`, `kafedra`, `dr`) VALUES ('$number', '$fio', '$id', '$osn_h', '$doljnost', '$step', '$kafedra', '$dr')";
	$rs = mysql_query($strCR, $db);
	echo "All OK!";
	echo "<a href = '../spisok.php' style = 'color:red'>Back</a>";
}


?>




<form method = "POST">

<link href="/style/style_create.css" rel="stylesheet">

 <a>№</a>   <div>   <input type = "text" size = "30" name = "number"/></div>

 <a>ФИО</a>    <div>      <input type = "text" size = "30" name = "fio"/></div>

  <a>Ид.номер</a>  <div>   <input type = "text" size = "30" name = "id"/></div>

  <a>Основ. для работы</a>  <div> <input type = "text" size = "30" name = "osn_h"/></div>

  <a>Должность</a>   <div> <input type = "text" size = "30" name = "doljnost"/></div>

 <a>Научная степень</a>  <div> <input type = "text" size = "30" name = "step"/></div>

  <a>Кафедра</a>  <div> <input type = "text" size = "30" name = "kafedra"/></div>

 <a>День рождения</a>   <div><input type = "text" size = "30" name = "dr"/></div>

<div><input type = "submit" name = "create" /></div>


</form>