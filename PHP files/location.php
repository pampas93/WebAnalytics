<?php

ini_set('max_execution_time', 900); //Changing default execution time limit from 30sec to 5min.

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

$sql = "SELECT distinct IPaddress from newTable";	//Finding only the Distinct IPaddresses.

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

$sql1="CREATE TABLE geoIpStats (
IP VARCHAR(50) NOT NULL,
Country VARCHAR(50),
CountryCode VARCHAR(10),
City VARCHAR(50),
Currency VARCHAR(10)
)";

$result1=mysql_query($sql1);
if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
    exit;
}


require_once('geopluginEdit.class.php');

$geoplugin = new geoPlugin();

while($row = mysql_fetch_array($result))
{
	$user_ip = $row["IPaddress"];

	$geoplugin->locate($user_ip);    //Put require IP in the locate() function.

	$country = $geoplugin->countryName;
	$city = $geoplugin->city;
	$curr = $geoplugin->currencyCode;
	$code = $geoplugin->countryCode;

	$sql2 = "INSERT INTO geoIpStats (IP,Country,CountryCode,City,Currency) VALUES ('$user_ip','$country','$code','$city','$curr')";
    $result2=mysql_query($sql2);
    if (!$result2) {
    	echo "Could not successfully run query ($sql2) from DB: " . mysql_error();
    exit;
	}

	/*echo "Geolocation results for {$geoplugin->ip}: <br />\n".
	"City: {$geoplugin->city} <br />\n".
	"Country Name: {$geoplugin->countryName} <br />\n".
	"Currency: {$geoplugin->currencyCode} <br />\n";
	*/

}

include '/CountryStats.php'

?>
