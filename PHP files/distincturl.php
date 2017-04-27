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

$sql = "SELECT distinct Page1 from newTable";	//Finding only the Distinct URLs.

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

$sql1="CREATE TABLE URLkeys (
DistinctURL VARCHAR(100) NOT NULL,
Key1 BIGINT(10) NOT NULL Primary Key
)";

$result1=mysql_query($sql1);
if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
    exit;
}

$alias = 1;

while($row = mysql_fetch_array($result))
{
	$url = $row["Page1"];

	$sql2 = "INSERT INTO URLkeys (DistinctURL, Key1) VALUES ('$url',$alias)";
    $result2=mysql_query($sql2);
    if (!$result2) {
    	echo "Could not successfully run query ($sql2) from DB: " . mysql_error();
    exit;
	}
    
    $alias = $alias+1;
	
}

include '/table2.php';
?>
