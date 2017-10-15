<?php
$db = mysql_connect('localhost', 'root', '');

mysql_select_db("prof_br", $db);
$data = $_POST;
if( isset($data['do_login']) )
{
	$errors = array();
	$link = mysql_query('SELECT * FROM `pas` WHERE `login` = "'.$data['login'].'"');
	if( mysql_num_rows($link) > 0 )
	{
		$user = mysql_fetch_array($link);
		
		if( $data['password'] == $user['password'] )
		{
			setcookie("user",$data['login'],time()+3600);
			header("Location: /index.php");
			exit;
		}else	$errors[] = 'Пароль неверный';
			
	}else	$errors[] = 'Логин не найден';
	if( ! empty($errors) )	echo "<script type = 'text/javascript'> alert('Логин/пароль введены не верно. Пробуйте еще раз!'); </script>";
}

?>

<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="utf-8" />
	<title>Авторизация</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">	
	<script src = "http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	
</head>
<body>
	
<div class="container" style="width: 30%; padding-top: 10%">
<form class="form-signin" role="form" method = "POST">
        <h2 class="form-signin-heading">Авторизация</h2>
        <input type="login" class="form-control" name = "login" id = "login" placeholder = "Логин"   value = "<?php echo @$data['login']; ?>"  required autofocus><br />
        <input type="password" class="form-control" name = "password" id = "pas" placeholder = "Пароль" value = "<?php echo @$data['password']; ?>" required>
        <br/ >
        <button class="btn btn-lg btn-primary btn-block" type="submit" name = "do_login">Войти</button>
      </form>
</div>
	
</body>
</html>