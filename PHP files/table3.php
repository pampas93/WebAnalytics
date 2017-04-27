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

$sql1 = "SELECT count(distinct(SessionNo)) as counter from sessionURL";

$result1=mysql_query($sql1);
if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
    exit;
}

$sql="CREATE TABLE table3 (
SessionNo int(11) NOT NULL,
PageKey BIGINT(10) NOT NULL
)";

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

$row = mysql_fetch_array($result1); //counting number of sessions
$c = $row["counter"];
//echo $c;

$i=1;

for($i =1; $i<=$c; $i++) //running the loop for c sessions
{
    $sql2 = "SELECT distinct `PageKey` as pg, `SessionNo` FROM `sessionurl` WHERE `SessionNo`=$i"; //finding distinct keys for each session
    $result2=mysql_query($sql2);
    if (!$result2) {
        echo "Could not successfully run query ($sql2) from DB: " . mysql_error();
    exit;
    }

    while($row = mysql_fetch_array($result2)) //Inserting these keys ans sessions into new table.
    {
        $p = $row["pg"];
        $s = $row["SessionNo"];

        $sql22 = "INSERT INTO table3 (SessionNo,PageKey) VALUES ('$s','$p')";
        $result22=mysql_query($sql22);
        if (!$result22) {
            echo "Could not successfully run query ($sql22) from DB: " . mysql_error();
        exit;
        }


    }
}

include '/flowmatrix.php';

?>