<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sample1project";

$con=mysql_connect($servername,$username,$password);

if(! $con)
{
die('Connection Failed'.mysql_error());
}

mysql_select_db($database,$con);

$sql = "SELECT * from newTable";

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

$sql1 = "UPDATE newTable set  date1 = STR_TO_DATE(date1,'%d/%m/%Y')";

$result1=mysql_query($sql1);

if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
exit;
}


/*
while($row = mysql_fetch_array($result))
{
	$date1 = $row["Date1"];

	$sql1 = "UPDATE newTable set  STR_TO_DATE('$date1','%d/%m/%Y')";

	$result1=mysql_query($sql1);
    if (!$result1) {
    	echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
    exit;
	}
}
*/

?>