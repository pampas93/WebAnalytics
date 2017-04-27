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

$sql = "SELECT distinct `Date1` as dat from newTable ";

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

$sql1="CREATE TABLE visitorStats (
Date1 VARCHAR(20) NOT NULL,
Hits int,
UniqueHits int
)";

$result1=mysql_query($sql1);
if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
    exit;
}

while ($row = mysql_fetch_array($result)) 
{
	$d = $row["dat"];

	$sql2 = "SELECT count(distinct IPaddress) from newTable where Date1 = '$d' ";

	$result2=mysql_query($sql2);
	$uh = mysql_fetch_array($result2);

	$sql3 = "SELECT count(IPaddress) from newTable where Date1 = '$d' ";

	$result3=mysql_query($sql3);
	$h = mysql_fetch_array($result3);

	$unique =  $uh[0];
	$hit = $h[0];

	$sql22 = "INSERT INTO visitorStats (Date1,Hits,UniqueHits) VALUES ('$d','$hit','$unique')";
    $result22=mysql_query($sql22);

    if (!$result22) {
    echo "Could not successfully run query ($sql22) from DB: " . mysql_error();
    exit;
	}
}




/*$row = mysql_fetch_array($result);
$users = $row[0];

echo "Distinct number of users :" ,$users;
*/
?>