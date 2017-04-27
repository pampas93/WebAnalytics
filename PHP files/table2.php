<?php

require_once 'linkedlist.class.php';

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

$sql = "SELECT * from newTable";

$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

$sql1="CREATE TABLE table2 (
IP VARCHAR(50) NOT NULL,
SessionNo int(11) NOT NULL,
ReqPage VARCHAR(200) NOT NULL,
date2 TIME NOT NULL,
ReqCode VARCHAR(10)
)";

$result1=mysql_query($sql1);
if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
   exit;
}

$counter = 1;
$list = new LinkList();

while($row = mysql_fetch_array($result))
{
    $a = $row["IPaddress"];
    $b = $row["Page1"];
    $c = $row["Date1"];

    //$s = " SELECT STR_TO_DATE('$c','%h:%i:%s')";
    //$t=mysql_query($s);

    $temp = $list->find($a,$c);

    if($temp!=null)
    {
    	//Need to subtract time> $t = $value[1]- $c;
    	//if $t <10; run below code.

        
        $sql22 = "INSERT INTO table2 (IP,SessionNo,ReqPage,date2) VALUES ('$a','$temp','$b', '$c')";
    	$result22=mysql_query($sql22);
    	if (!$result22) {
    		echo "Could not successfully run query ($sql22) from DB: " . mysql_error();
    	exit;
		}

		/*else $t>10,
		
		$list->insertLast($a,$c,$counter);

		$sql23 = "INSERT INTO table2 (IP,SessionNo,ReqPage,date2) VALUES ('$a','$counter','$b', '$c')";
    	$result23=mysql_query($sql23);
    	if (!$result22) {
    		echo "Could not successfully run query ($sql23) from DB: " . mysql_error();
    	exit;
		}

		counter++;
		*/


    }
    else
    {
    	$list->insertLast($a,$c,$counter);

    	$sql2 = "INSERT INTO table2 (IP,SessionNo,ReqPage,date2) VALUES ('$a','$counter','$b', '$c')";
    	$result2=mysql_query($sql2);
    	if (!$result2) {
    		echo "Could not successfully run query ($sql2) from DB: " . mysql_error();
    	exit;
		}

		$counter++;

    }

} 

include '/sessionURL.php';
?>