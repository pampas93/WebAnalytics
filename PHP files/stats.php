<?php

/*Most popular country, city.
Most popular user(based on IP). */


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

$sql = "SELECT Country FROM geoipstats 
		GROUP BY Country ORDER BY COUNT(Country) DESC  
		LIMIT  1";

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}
$row = mysql_fetch_array($result);
echo "Country with the Maximum Hits : {$row["Country"]} <br />\n";




$sql1 = "SELECT City FROM geoipstats 
		GROUP BY City ORDER BY COUNT(City) DESC  
		LIMIT  2";

$result1=mysql_query($sql1);
if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
    exit;
}

$row = mysql_fetch_array($result1);
$row = mysql_fetch_array($result1);
echo "City with the Maximum Hits : {$row["City"]} <br />\n";



//Finding most common currency.

$sql4 = "SELECT Currency FROM geoipstats 
		GROUP BY Currency ORDER BY COUNT(Currency) DESC  
		LIMIT  1";

$result4=mysql_query($sql4);
if (!$result4) {
    echo "Could not successfully run query ($sql4) from DB: " . mysql_error();
    exit;
}
$row = mysql_fetch_array($result4);

echo "Most Common Currency used : {$row["Currency"]} <br />\n";




//Find IP with maximum activity.
$sql2 = "SELECT IPaddress FROM newTable 
		GROUP BY IPaddress ORDER BY COUNT(IPaddress) DESC  
		LIMIT  1";

$result2=mysql_query($sql2);
if (!$result2) {
    echo "Could not successfully run query ($sql2) from DB: " . mysql_error();
    exit;
}

$row = mysql_fetch_array($result2);
$maxIP = $row["IPaddress"];

$sql3 = "SELECT * FROM geoipstats where IP = '$maxIP' ";
$result3=mysql_query($sql3);
if (!$result3) {
    echo "Could not successfully run query ($sql3) from DB: " . mysql_error();
    exit;
}
$row = mysql_fetch_array($result3);

echo "User with maximum Activity on the Site : $maxIP &nbsp;&nbsp; City: {$row["City"]} &nbsp; Country:{$row["Country"]}<br />\n";


?>
