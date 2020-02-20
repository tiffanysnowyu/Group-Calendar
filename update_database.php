#!/usr/local/bin/php -d display_errors=STDOUT
<?php
  // begin this XHTML page
  print('<?xml version="1.0" encoding="utf-8"?>');
  print("\n");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<title>Update database 2</title> 
</head>
<body>
<p>
<?php 


$database = "dbtiffanysnowyu.db";          


try  
{     
     $db = new SQLite3($database);
}
catch (Exception $exception)
{
    echo '<p>There was an error connecting to the database!</p>';

    if ($db)
    {
        echo $exception->getMessage();
    }
        
}

	print "<form action='calendar2.php' method='post'>";

// define tablename and field names for a SQLite3 query to create a table in a database
	$table = "event_table";
	$field1 = "person";
	$field2 = "date";
	$field3 = "time";
	$field4 = "event_title";
	$field5 = "event_message";

	$sql= "CREATE TABLE IF NOT EXISTS $table (
	$field1 varchar(100),
	$field2 varchar(10),
	$field3 varchar(5),
	$field4 varchar(100),
	$field5 varchar(300)
	)";
	$result = $db->query($sql);

	print "<h3>Creating the table</h3>";
	print "<p>$sql</p>";

	$person = $_POST['person'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$event_title = $_POST['event_title'];
	$event_msg = $_POST['event_message'];	

//  Insert a new record to database 

	$sql = "INSERT INTO $table ($field1,$field2,$field3,$field4,$field5) VALUES('$person','$date','$time','$event_title','$event_msg')";

print "Inserting a new record to the bruins table the command I am using is:"."</br>";
print "$sql";
$result = $db->query($sql);

/* debug
$sql = "DELETE FROM $table";
$result = $db->query($sql);
*/

$sql = "SELECT * FROM $table";
$result = $db->query($sql);

print "<table border='border'>\n";
print "  <tr>\n";
print "     <th>" . $field1 . "</th>\n";
print "     <th>" . $field2 .	 "</th>\n";
print "     <th>" . $field3 . "</th>\n";
print "     <th>" . $field4 . "</th>\n";
print "     <th>" . $field5 . "</th>\n";
print "  </tr>\n";

// obtain the results from the SELECT query as an array holding a record
// one iteration per record for this select query
while($record = $result->fetchArray(SQLITE3_ASSOC))
{  
  print "  <tr>\n";
  
  print " <td>" . $record[$field1]. "</td>\n";
  print " <td>" . $record[$field2]. "</td>\n";
  print " <td>" . $record[$field3]. "</td>\n";
  print " <td>" . $record[$field4]. "</td>\n";
  print " <td>" . $record[$field5]. "</td>\n";

  // Each iteration of the loop should write a table row  
  print "  </tr>\n";
}

print "</table>\n";

	date_default_timezone_set('America/Los_Angeles');
	$ts = date('G:00',strtotime($time)); //note: decode it as g:00A later
	
	print "<input type='submit' value='Go to calendar' />";
	print "</form>";
?>
</body>
</html>
