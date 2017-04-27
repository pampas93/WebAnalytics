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

$sql = "SELECT * from CountryStats";

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

$data = array();
$data[] = ['Country','Hits'];

while ($row = mysql_fetch_array($result))
{
	$name = $row['Country'];
	$code = $row['Code'];
	$hit = $row['Hits'];
	$data[] = [$name, (int)$hit];
}

json_encode($data);

//echo json_encode($data);
?>