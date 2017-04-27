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

$sql1 = "SELECT * from table2, URLkeys 
        where table2.ReqPage = URLkeys.DistinctURL";

$result1=mysql_query($sql1);
if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
    exit;
}


$sql="CREATE TABLE SessionURL (
SessionNo int(11) NOT NULL,
PageKey BIGINT(10) NOT NULL
)";

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
   exit;
}

while($row = mysql_fetch_array($result1))
{
    $s = $row["SessionNo"];
    $k = $row["Key1"];

    $sql22 = "INSERT INTO SessionURL (SessionNo,PageKey) VALUES ('$s','$k')";
    $result22=mysql_query($sql22);
    if (!$result22) {
        echo "Could not successfully run query ($sql22) from DB: " . mysql_error();
    exit;
    }

} 

include '/table3.php';
?>