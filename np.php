<?php
mysql_select_db("prof_br", $db);
$strSQL = "SELECT dr FROM spisok";     // запрос
$rs1 = mysql_query($strSQL, $db);
$day = date('d');
$month = date('m');
$year = date('Y');
$k = 0;



if($day > 24)
{
	$k = 1;
}


$massiv_dr_today = array();
$massiv_dr_mos = array();
$massiv_dr_moz = array();
$massiv_all = array();


while($row = mysql_fetch_array($rs1))
{
	$t = date_create($row['dr'])->format('m');
	
	if($t == $month and $row['dr'] != NULL)
	{
		$massiv_dr_mos[] = $row['dr'];
	}
    if($k == 1)
	{
		if($t == ($month + 1))
	    {
		$massiv_dr_moz[] = $row['dr'];
		}
	}
	
}


for ($i = 0; $i<=count($massiv_dr_mos); $i++)
{
	$d = date_create($massiv_dr_mos[$i])->format('d');
	if ($day == $d and $massiv_dr_mos[$i] != NULL)
	{
		
		$massiv_dr_today[] = $massiv_dr_mos[$i];
		
	}
	
	if ($d <= ($day+5) and  $d > $day and $massiv_dr_mos[$i] != NULL)
	{
		
		$massiv_all[] = $massiv_dr_mos[$i];
		
	}
	
	
}


if(count($massiv_dr_moz) != NULL)
{
	for ($i = 0; $i<=count($massiv_dr_moz); $i++)
    {
		$d = date_create($massiv_dr_moz[$i])->format('d');
		if ($d <= ($day-20)  and $massiv_dr_moz[$i] != NULL)
		{
		
		$massiv_all[] = $massiv_dr_moz[$i];
		
		}
	}	
}	










?>

