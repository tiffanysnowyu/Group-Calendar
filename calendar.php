#!/usr/local/bin/php -d display_errors=STDOUT
<!DOCTYPE html>
<head>
<title>Calendar</title> 

<link rel="stylesheet" type="text/css" href="calendar.css" />
<?php
	date_default_timezone_set('America/Los_Angeles');

	$ts = time();

	$mult = 0;

	function get_hour_string($timestamp){
  		global $mult;
		
		$time = date("d/m/Y H:i:s",$timestamp);
		
		$colTime = date("g:00A",strtotime($time)+60*60*$mult);
  		
		echo $colTime;
		
		$mult++;
	}
	
	$timey = $_GET['sub'];
	print $timey;
?>
</head>
<body>

<div class="container">
<h1>Schedule for <?php 
date_default_timezone_set('America/Los_Angeles');
echo date("D, F j, Y, g:iA",$ts);
?></h1>
<?php 
	print '<table id="event_table">';
	print '<tr>';
	print '<th class="hr_td"> &nbsp; </th> <th class="table_header">Tiffany</th><th class="table_header">Tasfin</th><th class="table_header">Sookie</th>';
	print '</tr>'; 

	$hours_to_show = 12;
	for($i=1;$i<(($hours_to_show/2)+1);$i++){
		print '<tr class="even_row">'; 
		print '<td class="hr_td">';
		get_hour_string($ts);
		print '</td> <td> </td> <td> </td> <td></td>';
		print '</tr>';
		
		print '<tr class="odd_row">'; 
		print '<td class="hr_td">';
		get_hour_string($ts);
		print '</td> <td> </td> <td> </td> <td></td>';
		print '</tr>';
	}
	print '</table>';
?>
	
</div>
</body>

</div>
</body>
</html>
