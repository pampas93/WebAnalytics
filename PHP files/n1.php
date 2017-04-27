<?php

ini_set('max_execution_time', 900); //Changing default execution time limit from 30sec to 15min.

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

$sql = "SELECT * from samplerawdata where Request NOT LIKE '/wp-%' AND Request NOT LIKE '%robots.txt%' AND CODE NOT LIKE '40%' AND CODE NOT LIKE '50%' ";

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

if (mysql_num_rows($result) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}

$sql1="CREATE TABLE newTable (
IPaddress VARCHAR(50) NOT NULL,
size int(20) NOT NULL,
Date1 VARCHAR(20) NOT NULL,
Time1 VARCHAR(20) NOT NULL,
Page1 TEXT NOT NULL,
Referral TEXT NOT NULL
)";

$result1=mysql_query($sql1);
if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
    exit;
}


while($row = mysql_fetch_array($result))
{
	if ($row["Request"]=="/feed/" or $row["Method"]=="POST" ) 
	{
		continue;
	}
	$ip = $row["IP"];
    $size = $row["Size"];
    $datetime = $row["Date-Time"];	//variable with unformatter date and time
    $page = $row["Request"];
    $ref = $row["Referral"];

    $p = strpos($datetime, '['); //searching of the [ postion in datetime and extract data after that.
    //echo $p;
    $date = substr($datetime, $p+1,$p+11); //extract date
    //echo "$date  ";

    //$date = STR_TO_DATE('$date1','%d/%m/%Y'); 

    $time = substr($datetime, $p+13,$p+20); //extract time
    //echo "$time";

    $sql2 = "INSERT INTO newTable (IPaddress,size,Date1,Time1,Page1,Referral) VALUES ('$ip','$size','$date','$time','$page','$ref')";
    $result2=mysql_query($sql2);
    if (!$result2) {
    	echo "Could not successfully run query ($sql2) from DB: " . mysql_error();
    exit;
	}
}

/*  WORKS FINE
while ($row = mysql_fetch_array($result)) {
    $ip = $row["IP"];
    $size = $row["Size"];
    echo "ip: ".$ip."<br>";
}
echo "Number of records: ".mysql_num_rows($result);
*/

//$con->close();
include '/location.php';

header( "refresh:0.5;url=../HTMLCss/homepage.html" );


?>