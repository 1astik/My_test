<?php
if( isset($_POST['down']) )   {
	setcookie("user","",time()-3600);
	header("Location: /avto.php");
	exit;
	}
if ($_COOKIE['user'] == '')
{
	header("Location: /avto.php");
	exit;
}
if ( isset($_POST['save']) )
{
	$db = mysql_connect('localhost', 'root', '');
	mysql_select_db("prof_br", $db);
	$tema = $_POST['tema'];
	$text = $_POST['text'];
			
	$strCR = "INSERT INTO lenta (`tema`, `text`) VALUES ('$tema', '$text')";
	$rs = mysql_query($strCR, $db);
	
}
$db = mysql_connect('localhost', 'root', '');
require "np.php";
$strSQL = "SELECT tema,text FROM lenta ";  
$rs1 = mysql_query($strSQL, $db);
$num_rows = mysql_num_rows($rs1);
for ($i = 1; $i<=($num_rows - 3); $i++)
$row1 = mysql_fetch_array($rs1);

?>

<!DOCTYPE html>
<html lang="ru-RU">
<head>
    
<meta charset="utf-8">
<title>Test</title>
  
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>  
  

  
</head>
<body>


<nav class="navbar navbar-default navbar-static">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".js-navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="padding:15px 15px;">Профбюро</a>
        </div>
        <div class="collapse navbar-collapse js-navbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Списки
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="spisok.php">Список кафедры</a></li>
						<li><a href="#">Список профбюро</a></li>
						<li><a href="#">Список профгрупоргов</a></li>
						<li><a href="#">Список детей</a></li>
						<li><a href="#">Список билетов</a></li>
                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Выписки
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Выписка</a></li>
                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Прочие документы
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Дни рождения</a></li>
                        
                    </ul>
                </li>
				<li class="dropdown">
                    <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        График
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">График проведения собраний</a></li>
                        
                    </ul>
                </li>
			 </ul>
            
			<form method = "POST" class= "form-inline navbar-form navbar-right">
				<div class = "form-group">
					<label class = "control-label"><?php echo 'Добро пожаловать, ' . @$_COOKIE["user"]. '!';  ?></label>
					<button type = "submit" name = "down"  class = "btn btn-default">Выход</button>
				</div>
			</form>
			
			
        </div>
    </div>
</nav>

  
<div class = "row">
		<div class = "col-md-6" style = "margin-left:30px">
		    <div class="panel panel-primary">  
		        <div class="panel-heading"><span><?php $row1 = mysql_fetch_array($rs1); echo $row1['tema'];  ?></span></div>
				<div class="panel-body"><p><?php  echo $row1['text'];  ?></p></div>
			</div>
			<div class="panel panel-primary">  
					<div class="panel-heading"><span><?php $row1 = mysql_fetch_array($rs1); echo $row1['tema'];  ?></span></div>
					<div class="panel-body"><p><?php  echo $row1['text'];  ?></p></div>
			</div>	
			
			<div class="panel panel-primary">  
					<div class="panel-heading"><span><?php $row1 = mysql_fetch_array($rs1); echo $row1['tema'];  ?></span></div>
					<div class="panel-body"><p><?php  echo $row1['text'];  ?></p></div>
			</div>
			
			<form method = "POST">
			<div class = "panel panel-success" style = "width:500px">  
					<div class = "panel-heading"><span >Создать сообщение</span></div><br />
					<p> <span> Тема</span> <input type = "text" size = "30" name = "tema" placeholder = "Тема" />   </p>
					<p> <span> Текст</span> <textarea name="text" cols="40" rows="3" placeholder = "Текс сообщения"></textarea></p>
					<button class="btn btn-lg btn-success btn-block" type="submit" name = "save">Cоздать</button>
					
			</div>		
			</form>	
		</div>

		<div class="col-md-4" style = "width:400px; float:right; margin-right:30px">
			<div id = "right" class="panel panel-info" >
				<span class = "panel-heading"> Скоро День рожденья у:</span>
				<div class="panel-body"><p><?php 
					for ($i = 0; $i<count($massiv_all); $i++)
					{
					 $strSQL = "SELECT fio,dr FROM spisok WHERE dr = '$massiv_all[$i]'" ;     // запрос
					 $rs = mysql_query($strSQL, $db);
					 $row = mysql_fetch_array($rs);  
					 echo $row['fio'], "   будет  " , (date('Y')-date_create($row['dr'])->format('Y')), "<br>";
					} ?> </p></div>
			</div>
			
		
			<div id = "right" class="panel panel-info">  
		        <span class = "panel-heading"> Сегодня День рожденья у:</span> 
				<div class="panel-body"><p><?php 
				for ($i = 0; $i<count($massiv_dr_today); $i++)
				{
				 $strSQL = "SELECT fio,dr FROM spisok WHERE dr = '$massiv_dr_today[$i]'" ;     // запрос
				 $rs = mysql_query($strSQL, $db);
				 $row = mysql_fetch_array($rs);  
				 echo $row['fio'], "     будет  " , (date('Y')-date_create($row['dr'])->format('Y')); echo " лет";gfd
				}
				?></p></div>
			</div>	
		</div>
		
</div>   
    	

		



		    
</body>
</html>