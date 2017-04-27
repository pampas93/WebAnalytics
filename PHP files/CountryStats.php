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

$sql = "SELECT distinct Country from geoipstats";	//Finding only the Distinct Countries.

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

$sql1="CREATE TABLE CountryStats (
Country VARCHAR(50) NOT NULL,
Code VARCHAR(5),
Hits INT(12)
)";

$result1=mysql_query($sql1);
if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
    exit;
}

while($row = mysql_fetch_array($result))
{
	$max = $row["Country"];
	$sql2 = "SELECT Count(*) from geoipstats where Country = '$max' ";
	$result2=mysql_query($sql2);
	if (!$result2) {
    echo "Could not successfully run query ($sql2) from DB: " . mysql_error();
    exit;
	}

	$count = mysql_fetch_array($result2);

    //echo "{$row["Country"]}  $count[0]";

    $sql9 = "SELECT CountryCode from geoipstats where Country = '$max' ";
	$result9=mysql_query($sql9);

	$c = mysql_fetch_array($result9);
	$code = $c['CountryCode'];

    $sql3 = "INSERT INTO CountryStats (Country,Code,Hits) VALUES ('$max','$code', $count[0])";
    $result3=mysql_query($sql3);
    if (!$result3) {
    	echo "Could not successfully run query ($sql3) from DB: " . mysql_error();
    exit;
	}

}
/*
$sql4 = "UPDATE CountryStats ORDER BY Hits";
$result4=mysql_query($sql4);
if (!$result4) {
   	echo "Could not successfully run query ($sql4) from DB: " . mysql_error();
exit;
}*/


$sql = "SELECT * from CountryStats";

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

$data = array();

while ($row = mysql_fetch_array($result))
{
    $val = $row['Country'];
    $hit = $row['Hits'];
    $data[] = [$val, (int)$hit];
}

echo json_encode($data);

include '/distincturl.php';
?>
