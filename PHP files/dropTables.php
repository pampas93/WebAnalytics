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

$sql = "DROP TABLE newTable";
$result=mysql_query($sql);

$sql = "DROP TABLE countrystats";
$result=mysql_query($sql);

$sql = "DROP TABLE geoipstats";
$result=mysql_query($sql);

$sql = "DROP TABLE sessionurl";
$result=mysql_query($sql);

$sql = "DROP TABLE table2";
$result=mysql_query($sql);

$sql = "DROP TABLE table3";
$result=mysql_query($sql);

$sql = "DROP TABLE toplanding";
$result=mysql_query($sql);

$sql = "DROP TABLE urlkeys";
$result=mysql_query($sql);

$sql = "DROP TABLE visitorstats";
$result=mysql_query($sql);

?>