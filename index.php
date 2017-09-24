<?php



if( isset($_POST['down']) )
{ 	 
     setcookie("user","",time()-3600);
}


if ($_COOKIE['user'] == '')
{
	header('Location: /avto.php');
	exit();
}
else
{
	echo '<div id = "nadpis">Профбюро</div><hr>';
}


require "np.php";

for ($i = 0; $i<count($massiv_dr_today); $i++)
			{
			 $strSQL = "SELECT fio,dr FROM spisok WHERE dr = '$massiv_dr_today[$i]'" ;     // запрос
			 $rs = mysql_query($strSQL, $db);
			 $row = mysql_fetch_array($rs);  
			 echo "<script>alert(\"Сегодня День рождения у  ".$row['fio'].".\");</script>";
			}



if ( isset($_POST['save']) )
{
	
	$tema = $_POST['tema'];
	$text = $_POST['text'];
			
	$strCR = "INSERT INTO lenta (`tema`, `text`) VALUES ('$tema', '$text')";
	$rs = mysql_query($strCR, $db);
	
}



mysql_select_db("prof_br", $db);
$strSQL = "SELECT tema,text FROM lenta ";  
$rs1 = mysql_query($strSQL, $db);
$num_rows = mysql_num_rows( $rs1 );
for ($i = 1; $i<=($num_rows - 3); $i++)
$row1 = mysql_fetch_array($rs1);


?>


<form method = "POST">
    
	<link href="style/st1.css" rel="stylesheet">

	
	
<div id = "wrapper">

<nav class = "menu">
		<ul>
			<li><a href = "#">Списки</a>
				<ul>
					<li><a href = "spisok.php">Список кафедры</a></li>
					<li><a href = "sp_profbr.php">Список профбюро</a></li>
					<li><a href = "sp_profgrp.php">Список профгруппоргов</a></li>
					<li><a href = "child.php">Список детей</a></li>
					<li><a href = "prof_byletu.php">Список профсоюзных билтеов</a></li>
				</ul>
			</li>
			<li><a href = "#">Выписки</a>
			
				<ul>
					<li><a href = "#">Выписка</a></li>
					
	            </ul>
			</li>
			<li><a href = "#">Прочие документы</a>
				<ul>
					<li><a href = "test.html">Дни рождения</a></li>
					<li><a href = "lil.php">Документы</a></li>
				</ul>
			</li>
			<li><a href = "#">График</a>
				<ul>
					<li><a href = "lol.php">График проведения собраний</a></li>
					
	            </ul>
			</li>
			
			<li class = "helper"></li>
        </ul>
	
	</nav>

	<div id = "content"> 
		<div id = "news">  
		        <p id = "abzac"><?php $row1 = mysql_fetch_array($rs1); echo $row1['tema'];  ?></p>
				<p><?php    echo $row1['text'];  ?></p>
		</div>
    
    	<div id = "news">  
		        <p id = "abzac"><?php $row1 = mysql_fetch_array($rs1); echo $row1['tema'];  ?></p>
				<p><?php  echo $row1['text'];  ?></p>
		</div>

		<div id = "news">  
		        <p id = "abzac"><?php $row1 = mysql_fetch_array($rs1); echo $row1['tema'];  ?></p>
				<p><?php  echo $row1['text'];  ?></p>
		</div>
		<div id = "create_news">  
		        <p id = "abzac">Создать сообщение</p>
				<p> <a id = "abzac"> Тема</a> <input type = "text" size = "30" name = "tema"  />   </p>
				<p> <a id = "abzac"> Текст</a> <input type = "text" size = "30" name = "text"  /> </p>
				<p> <input type = "submit" name = "save" value = "Создать" /> </p>
				
		</div>

	</div>
	 
		
	
    <div id = "avtobar">
	<p><?php echo 'Добро пожаловать, ' . @$_COOKIE["user"]. '!';  ?></p>
		<p><button type = "submit" name = "down">Выход</button> </p>
	</div>
	
	
	<div id = "avto">
		<p id = "abzac"> Сегодня день рождения у:</p>
		<p><?php 
			for ($i = 0; $i<count($massiv_dr_today); $i++)
			{
			 $strSQL = "SELECT fio,dr FROM spisok WHERE dr = '$massiv_dr_today[$i]'" ;     // запрос
			 $rs = mysql_query($strSQL, $db);
			 $row = mysql_fetch_array($rs);  
			 echo $row['fio'], "   будет  " , (date('Y')-date_create($row['dr'])->format('Y')), "<br>";
			}
			?></p>
	</div>
	
	
	<div id = "avto">
		<p id = "abzac"> Скоро день рождения у:</p>
		<p id = "test"><?php 
			for ($i = 0; $i<count($massiv_all); $i++)
			{
			 $strSQL = "SELECT fio,dr FROM spisok WHERE dr = '$massiv_all[$i]'" ;     // запрос
			 $rs = mysql_query($strSQL, $db);
			 $row = mysql_fetch_array($rs);  
			 echo $row['fio'], "   будет  " , (date('Y')-date_create($row['dr'])->format('Y')), "<br>";
			}
			?></p>
	</div>
	
	
	<div>
		<table id="calendar3">
	<thead>
		<tr><td colspan="4"><select>
	<option value="0">Январь</option>
	<option value="1">Февраль</option>
	<option value="2">Март</option>
	<option value="3">Апрель</option>
	<option value="4">Май</option>
	<option value="5">Июнь</option>
	<option value="6">Июль</option>
	<option value="7">Август</option>
	<option value="8">Сентябрь</option>
	<option value="9">Октябрь</option>
	<option value="10">Ноябрь</option>
	<option value="11">Декабрь</option>
	</select><td colspan="3"><input type="number" value="" min="0" max="9999" size="4">
		<tr><td>Пн<td>Вт<td>Ср<td>Чт<td>Пт<td>Сб<td>Вс
	<tbody>
	</table>
</div>
	

	
	
	
	
	
	
	
 
	
</div>
	
		<div id = "footer">
<p>"Донецкий Национальный Университет"   @Design by MarkuS </p>
</div>
	
	
	

<script>
function Calendar3(id, year, month) {
var Dlast = new Date(year,month+1,0).getDate(),
    D = new Date(year,month,Dlast),
    DNlast = D.getDay(),
    DNfirst = new Date(D.getFullYear(),D.getMonth(),1).getDay(),
    calendar = '<tr>',
    m = document.querySelector('#'+id+' option[value="' + D.getMonth() + '"]'),
    g = document.querySelector('#'+id+' input');
if (DNfirst != 0) {
  for(var  i = 1; i < DNfirst; i++) calendar += '<td>';
}else{
  for(var  i = 0; i < 6; i++) calendar += '<td>';
}
for(var  i = 1; i <= Dlast; i++) {
  if (i == new Date().getDate() && D.getFullYear() == new Date().getFullYear() && D.getMonth() == new Date().getMonth()) {
    calendar += '<td class="today">' + i;
  }else{
    if (  // список официальных праздников
        (i == 1 && D.getMonth() == 0 && ((D.getFullYear() > 1897 && D.getFullYear() < 1930) || D.getFullYear() > 1947)) || // Новый год
        (i == 2 && D.getMonth() == 0 && D.getFullYear() > 1992) || // Новый год
        ((i == 3 || i == 4 || i == 5 || i == 6 || i == 8) && D.getMonth() == 0 && D.getFullYear() > 2004) || // Новый год
        (i == 7 && D.getMonth() == 0 && D.getFullYear() > 1990) || // Рождество Христово
        (i == 23 && D.getMonth() == 1 && D.getFullYear() > 2001) || // День защитника Отечества
        (i == 8 && D.getMonth() == 2 && D.getFullYear() > 1965) || // Международный женский день
        (i == 1 && D.getMonth() == 4 && D.getFullYear() > 1917) || // Праздник Весны и Труда
        (i == 9 && D.getMonth() == 4 && D.getFullYear() > 1964) || // День Победы
        (i == 12 && D.getMonth() == 5 && D.getFullYear() > 1990) || // День России (декларации о государственном суверенитете Российской Федерации ознаменовала окончательный Распад СССР)
        (i == 7 && D.getMonth() == 10 && (D.getFullYear() > 1926 && D.getFullYear() < 2005)) || // Октябрьская революция 1917 года
        (i == 8 && D.getMonth() == 10 && (D.getFullYear() > 1926 && D.getFullYear() < 1992)) || // Октябрьская революция 1917 года
        (i == 4 && D.getMonth() == 10 && D.getFullYear() > 2004) // День народного единства, который заменил Октябрьскую революцию 1917 года
       ) {
      calendar += '<td class="holiday">' + i;
    }else{
      calendar += '<td>' + i;
    }
  }
  if (new Date(D.getFullYear(),D.getMonth(),i).getDay() == 0) {
    calendar += '<tr>';
  }
}
for(var  i = DNlast; i < 7; i++) calendar += '<td>&nbsp;';
document.querySelector('#'+id+' tbody').innerHTML = calendar;
g.value = D.getFullYear();
m.selected = true;
if (document.querySelectorAll('#'+id+' tbody tr').length < 6) {
    document.querySelector('#'+id+' tbody').innerHTML += '<tr><td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;';
}
document.querySelector('#'+id+' option[value="' + new Date().getMonth() + '"]').style.color = 'rgb(220, 0, 0)'; // в выпадающем списке выделен текущий месяц
}
Calendar3("calendar3",new Date().getFullYear(),new Date().getMonth());
document.querySelector('#calendar3').onchange = function Kalendar3() {
  Calendar3("calendar3",document.querySelector('#calendar3 input').value,parseFloat(document.querySelector('#calendar3 select').options[document.querySelector('#calendar3 select').selectedIndex].value));
}
</script>


	
</form>