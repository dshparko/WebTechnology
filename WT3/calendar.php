<?php
// проверки
$incorrect_year = 0;
$incorrect_kurs = 0;
	if ($_GET) {
		if (isset($_GET['year'])) {
			$year = $_GET["year"]-1;
			 if(($year <= 2100) && ($year >= 1970))
		 		$incorrect_year = 0;
		 	else {
		 		$incorrect_year = 1;
		 		exit;
		 	}
		}

		if (isset($_GET["kurs"])) {
			$kurs = $_GET["kurs"];
			if (($year <= 2100) && ($year >= 1970))
				$incorrect_kurs = 0;
			else {
				$incorrect_kurs = 1;
				exit;
			}
		}
	}

	$Month_r = array(
	"1" => "январь",
	"2" => "февраль",
	"3" => "март",
	"4" => "апрель",
	"5" => "май",
	"6" => "июнь",
	"7" => "июль",
	"8" => "август",
	"9" => "сентябрь",
	"10" => "октябрь",
	"11" => "ноябрь",
	"12" => "декабрь");

	$year_holidays = array(mktime(0,0,0,5,9,0),mktime(0,0,0,5,1,0),mktime(0,0,0,3,8,0),mktime(0,0,0,12,25,0),mktime(0,0,0,1,7,0),mktime(0,0,0,11,7,0));
	$year_sessial = array();

	if ($kurs <= 2) {
		for ($i = 1; $i <= 25; $i++){
			array_push($year_sessial,mktime(0,0,0,1,$i,0));
		}
		for ($i = 5; $i <= 30; $i++){
			array_push($year_sessial,mktime(0,0,0,6,$i,0));
		}
		for ($i = 26; $i <= 31; $i++){
			array_push($year_holidays,mktime(0,0,0,1,$i,0));
		}
		for ($i = 1; $i <= 8; $i++){
			array_push($year_holidays,mktime(0,0,0,2,$i,0));
		}
	} else {
		for ($i = 12; $i <= 25; $i++){
			array_push($year_holidays,mktime(0,0,0,1,$i,0));
		}
		for ($i = 22; $i <= 31; $i++){
			array_push($year_sessial,mktime(0,0,0,12,$i,0));
		}
		for ($i = 1; $i <= 12; $i++){
			array_push($year_sessial,mktime(0,0,0,1,$i,0));
		}
		for ($i = 18; $i <= 31; $i++){
			array_push($year_sessial,mktime(0,0,0,5,$i,0));
		}
		for ($i = 1; $i <= 7; $i++){
			array_push($year_sessial,mktime(0,0,0,6,$i,0));
		}
	}

	$work_week = 1;
	$curr_month = 9;

// инициализация файла
	$fd = fopen("Calendar_output.html", 'w');
	$str =
"<!DOCTYPE html>
<html lang='ru'>
<head>
	<meta charset='utf-8'>
	<title>Календарь</title>
	<link rel='stylesheet' href='calendar.css'>
</head>
<body>\n";
	fwrite($fd,$str);
// инициализация таблицы
	$str =
	"\n<table width='390px' style='border: 1px solid #cccccc';>
	<tr>
		<td class='datehead'>УН</td>
        <td class='datehead'>Пн</td>
        <td class='datehead'>Вт</td>
        <td class='datehead'>Ср</td>
        <td class='datehead'>Чт</td>
        <td class='datehead'>Пт</td>
        <td class='datehead'>Сб</td>
        <td class='datehead'>Вс</td>
    </tr>\n";
    fwrite($fd,$str);

// цикл по месяцам
	while ($curr_month != 7) {
// инициализация переменных
		$curr = mktime(0,0,0,$curr_month,1,$year);
		$max_days = date("t", $curr);
		$day = 1;
		$day_info = getdate($curr);
//0 - понедельник 6 - вскр
		$week_day = $day_info['wday'] - 1;
		if ($week_day == -1)
			$week_day = 6;

		fwrite($fd,"	<tr>\n		<td colspan='8' align=center style = 'color: blue'>");
		fwrite($fd,$Month_r[$curr_month]);
		fwrite($fd,"</td>\n	</tr>\n");
//начало новой строки нового месяца + УН
		fwrite($fd,"	<tr>\n");
		fwrite($fd,"		<td class='workweek'>". $work_week . "</td>\n");
		if ($work_week == 5)
			$work_week = 1;
//форматирование (дни недели под днями недели, пустые ячейки)
		for ($i = 0; $i<$week_day; $i++)
			fwrite($fd,"		<td></td>\n");
//цикл по дням месяца
		while ($day <= $max_days) {
			if (($week_day == 0) && ($day != 1))
				fwrite($fd,"		<td class='workweek'>". $work_week . "</td>\n");
			if (($week_day >= 5) && ($week_day <= 6) || (in_array(mktime(0,0,0,$curr_month,$day,0),$year_holidays)))
				fwrite($fd,"		<td class='holiday'>". $day . "</td>\n");
			else if (in_array(mktime(0,0,0,$curr_month,$day,0),$year_sessial))
				fwrite($fd,"		<td class='sessial'>". $day . "</td>\n");
			else
				fwrite($fd,"		<td class='datehead'>". $day . "</td>\n");
			$week_day++;
			$day++;
			if ($week_day == 7) {
				fwrite($fd,"	</tr>\n    <tr>\n");
				$week_day = 0;
				$work_week++;
				if ($work_week == 5)
					$work_week = 1;
			}
			if ($day == $max_days+1)
				 fwrite($fd,"	</tr>\n");

		}
		$curr_month++;
		if ($curr_month == 13) {
			$curr_month = 1;
			$year++;
		}
	}
	fprintf($fd,"	</table>\n");
	fprintf($fd,"</body>\n</html>");
	fclose($fd);
	echo file_get_contents("Calendar_output.html");
?>
