<?PHP
function cleanData(&$str)
{
$str = preg_replace("/\t/", "\\t", $str);
$str = preg_replace("/\r?\n/", "\\n", $str);
if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
$arr_sp = array('�����', '���', '���', '����.��� ������', '���������', '������� �������', '�������', '���� ��������');
$arr_prf = array('�����', '���', '���', '�������', '���������', '����������', '������', '���� ��������');
$arr_prfg = array('�����', '���', '���', '�������', '���������', '����������', '������', '���� ��������');
$arr_ch = array('�����', '���_��������', '���', '���_�������', '���� ��������');
$arr_bl = array('�����', '���', '����� ������', '���� ������');
$arr_gr = array('�����', '�������', '����', '������������', '�����������', '�������������');
 // ��� ������������ ����� �����. 
$name = $_GET['id'];
$filename =  $name ."_".date('dmY'). ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$k = $name;
if ($k == 'spisok')
	{
		$arr = array(1);
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
// ����������� � ��
mysql_connect('localhost', 'root', ''); // ���� ���� � ������
mysql_select_db("prof_br") or die (mysql_error());// ��� ���� ������

//������� ��������� ��������� ������
mysql_query('SET character_set_database = cp1251_general_ci'); 
mysql_query ("SET NAMES 'cp1251'");

//������ � ����� ������
$flag = false;
$result = mysql_query("SELECT * FROM $name ORDER BY number") 
or die('������ �� ��������!');
foreach ($arr as $key => $value)
{
  $arr[$key] = iconv("UTF-8", "CP1251",$value);
}
 while(false !== ($row = mysql_fetch_assoc($result))) {
   if(!$flag) {
     // ����� ����������
     echo implode("\t", $arr) . "\r\n";
     $flag = true;
    }
    //����� ������ ��������    
     array_walk($row, 'cleanData');
     echo implode("\t", array_values($row)) . "\r\n";
  }
  
?>
