<?PHP
function cleanData(&$str)
{
$str = preg_replace("/\t/", "\\t", $str);
$str = preg_replace("/\r?\n/", "\\n", $str);
if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
$arr_sp = array('Номер', 'ФИО', 'ИНН', 'Оснв.для работы', 'Должность', 'Научная степень', 'Кафедра', 'Дата рождения');
$arr_prf = array('Номер', 'ФИО', 'ИНН', 'Кафедра', 'Должность', 'Информация', 'Адресс', 'Дата рождения');
$arr_prfg = array('Номер', 'ФИО', 'ИНН', 'Кафедра', 'Должность', 'Информация', 'Адресс', 'Дата рождения');
$arr_ch = array('Номер', 'ФИО_родителя', 'ИНН', 'ФИО_ребенка', 'Дата рождения');
$arr_bl = array('Номер', 'ФИО', 'Номер билета', 'Дата выдачи');
$arr_gr = array('Номер', 'Кафедра', 'Дата', 'Профгруппорг', 'Заместитель', 'Присутсвующий');
 // Имя загружаемого файла файла. 
$name = $_GET['id'];
$filename =  $name ."_".date('dmY'). ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

if ($name == 'spisok')
	{
		$arr = $arr_sp;
	}
else if ($name == 'prof_byro')
	{
		$arr = $arr_prf;
	}
else if ($name == 'prof_group_org')
	{
		$arr = $arr_prfg;
	}
else if ($name == 'child')
	{
		$arr = $arr_ch;
	}
else if ($name == 'byletu')
	{
		$arr = $arr_bl;
	}else
		$arr = $arr_gr;
// Подключение к бд
mysql_connect('localhost', 'root', ''); // Хост юзер и пароль
mysql_select_db("prof_br") or die (mysql_error());// Имя базы данных

//Указать кодировку выводимых данных
mysql_query('SET character_set_database = cp1251_general_ci'); 
mysql_query ("SET NAMES 'cp1251'");

//запрос и вывод данных
$flag = false;
$result = mysql_query("SELECT * FROM $name ORDER BY number") 
or die('Запрос не выполнен!');
foreach ($arr as $key => $value)
{
  $arr[$key] = iconv("UTF-8", "CP1251",$value);
}
 while(false !== ($row = mysql_fetch_assoc($result))) {
   if(!$flag) {
     // Вывод заголовков
     echo implode("\t", $arr) . "\r\n";
     $flag = true;
    }
    //Вывод данных столбцов    
     array_walk($row, 'cleanData');
     echo implode("\t", array_values($row)) . "\r\n";
  }
  
?>
