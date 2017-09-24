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
$db = mysql_connect('localhost', 'root', '');
mysql_select_db("prof_br", $db);
$strSQL = "SELECT number,fio,id,osn_h,doljnost,step,kafedra,dr FROM spisok  ORDER BY number";  
$rs = mysql_query($strSQL, $db); 
if (isset($_POST['create']))
{
	header('Location: /spisok/create.php');
	exit();
}
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
<script type="text/javascript" src="jsort/jquery-latest.js"></script>
<script type="text/javascript" src="jsort/jquery.tablesorter.js"></script>
<script type="text/javascript" src="jsort/jquery.tablesorter.pager.js"></script>
<script type="text/javascript" src="jsort/script.js"></script> 
 <script>
		function funcSuccess (data) {
			$("#info").text (data);
		}
	
		$(document).ready (function () {
			$('#load').bind("click" , function () {
				
			});	
		});
	</script> 

  
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href = "/lol.php" class="navbar-brand" style="padding:15px 15px;">Профбюро</a>
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
				<li class= "form-inline navbar-form">
					<form method = "POST" >
						<button type = "submit" name = "create"  class = "btn btn-success">Создать нову запись</button>
					</form>
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
		
<table id = "myTable" class="table table-hover table-bordered" style = "width:1200px; margin-left:30px; margin-top:70px">
  <thead>
    <tr>
      <th>#</th>
      <th style = "width:300px">ФИО</th>
	  <th >Ид.номер</th>
	  <th style = "width:50px">Основ. для работы</th>
	  <th >Должность</th>
	  <th >Научная степень</th>
	  <th >Кафедра</th>
	  <th style = "width:100px">День рождения</th>
	  <th style = "width:50px">Изменить</th>
	  <th style = "width:50px">Удалить</th>
    </tr>
  </thead>
  <tbody>
  
  <?php  while($row = mysql_fetch_array($rs)) {      ?>
    <tr>
      <th scope="row"><?php echo $row['number'];?></th>
      <td><?php echo $row['fio'];?></td>
      <td><?php echo $row['id'];?></td>
      <td><?php echo $row['osn_h'];?></td>
	  <td><?php echo $row['doljnost'];?></td>
      <td><?php echo $row['step'];?></td>
      <td><?php echo $row['kafedra'];?></td>
	  <td><?php echo date_create($row['dr'])->format('d.m.Y');?></td>
	  <td> <a href = "spisok/remake.php?id=<?php echo $row['number'];?>" class="glyphicon glyphicon-pencil" aria-hidden="true"></a></td>
	  <td> <a id = "del" style = "cursor:pointer" class="glyphicon glyphicon-trash" aria-hidden="true"></a></td>
    </tr>
  <?php }  ?>
  </tbody>
</table>


		    
</body>
</html>