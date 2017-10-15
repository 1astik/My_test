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

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script> 
 
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="all" />
 
 <script type="text/javascript">
 var id;

function funcDel (data) {
			alert("Удален элемент №" + data);
			window.location.reload();
}
 
function funcSend (data) {
			data = JSON.parse(data);
			document.getElementById("fio").value = data.fio;
			document.getElementById("inn").value = data.id;
			document.getElementById("osn_h").value = data.osn_h;
			document.getElementById("doljnost").value = data.doljnost;
			document.getElementById("step").value = data.step;
			document.getElementById("kafedra").value = data.kafedra;
			document.getElementById("dr").value = data.dr;
		}
function funcUpdate () {
			$("#f_contact").fadeOut("fast", function(){
				if (id != ""){
				$(this).before("<p><strong>Данные успешно изменены!</strong></p>");
				}else $(this).before("<p><strong>Данные успешно введены!</strong></p>");
				setTimeout(function() {window.location.reload();}, 1000);
				
				});
				
	   	 }
$(document).ready(function() {

	$("#f_create").fancybox({"padding" : 20});
		
	$('.glyphicon-trash').bind("click" , function () {
			id = this.id;
			if(confirm("Вы действительно хотите удалить элемент?")){
			$.ajax ({
					url: "del.php",
					type: "POST",
					data: ({name: id}),
					dataType: "html",
					success: funcDel
				});
			}	
	});
	
$(".glyphicon-pencil").fancybox({"padding" : 20})
	{
		$('.glyphicon-pencil').bind("click" , function (){
		id = this.id;
		$.ajax ({
					url: "content.php",
					type: "POST",
					data: ({name: id}),
					dataType: "html",
					success: funcSend
				});
		});
		
					
	};
	
$("#f_contact").submit(function(){ return false; });
    f_send.onclick = function() {
    var mas_val = [document.getElementById("fio").value, document.getElementById("inn").value, document.getElementById("osn_h").value, document.getElementById("doljnost").value, document.getElementById("step").value, document.getElementById("kafedra").value, document.getElementById("dr").value];
		$.ajax ({
			url: "update.php",
			type: "POST",
			data: ({mas: mas_val, number: id}),
			dataType: "html",
			success: funcUpdate
			});
	};

f_create.onclick = function() {$('#f_contact')[0].reset(); }

});
</script>

  
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href = "/index.php" class="navbar-brand" style="padding:15px 15px;">Профбюро</a>
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
				<li class= "form-inline navbar-form" >
					<div >
						<a id = "f_create" href = "#data"  class = "btn btn-success">Создать нову запись</a>
					</div>
				</li>
			 </ul>
            			
			<form method = "POST" class= "form-inline navbar-form navbar-right" >
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
	  <td> <a href="#data" id = "<?php echo $row['number'];?>"  class="glyphicon glyphicon-pencil" aria-hidden="true"></a></td>
	  <td> <a style = "cursor:pointer" id = "<?php echo $row['number'];?>" class="glyphicon glyphicon-trash" aria-hidden="true"></a></td>
    </tr>
  <?php }  ?>
  </tbody>
</table>


<div style="display:none" id = "test"><div id="data"><h2>Ввод данных</h2>
    <form id="f_contact"  method="POST" role = "form">
   
<div class= "form-group"><label for = "fio">ФИО</label>   <input class = "form-control" type = "text" size = "45"  id = "fio" placeholder = "ФИО"  /></div>

<div class= "form-group"><label for = "id">Ид.номер</label>   <input class = "form-control" type = "text" size = "30"  id = "inn"  placeholder = "ИНН" /></div>

<div class= "form-group"><label for = "osn_h">Основ. для работы</label>   <input class = "form-control" type = "text" size = "30" id = "osn_h"  placeholder = "Основание для работы"  /></div>

<div class= "form-group"><label for = "doljnost">Должность</label> <input class = "form-control" type = "text" size = "30" id = "doljnost"  placeholder = "Должность" /></div>

<div class= "form-group"><label for = "step">Научная степень</label>   <input class = "form-control" type = "text" size = "30" id = "step"  placeholder = "Научная степень" /></div>

<div class= "form-group"><label for = "kafedra">Кафедра</label>   <input class = "form-control" type = "text" size = "30" id = "kafedra"  placeholder = "Кафедра" /></div>

<div class= "form-group"><label for = "dr">День рождения</label>  <input class = "form-control" type = "text" size = "30" id = "dr"   placeholder = "День рождения" /></div>

<input class = "btn btn-success" type = "submit" name = "create" id="f_send" />
    </form></div></div>

		    
</body>
</html>