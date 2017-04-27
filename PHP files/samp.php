<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sample1project";
//$filename = "C:\Users\Pempmau5\Desktop";

$con=mysql_connect($servername,$username,$password);

if(! $con)
{
die('Connection Failed'.mysql_error());
}

$logfile = $_SERVER['DOCUMENT_ROOT'].'\\Book1.csv';

// open the csv file
$fp = fopen($logfile,"r");

//parse the csv file row by row
while(($row = fgetcsv($fp,"500",",")) != FALSE)
{
    //insert csv data into mysql table
    $sql = "INSERT INTO sample (sl1, sl2, sl3) VALUES('" . implode("','",$row) . "')";
    if(!mysqli_query($con, $sql))
    {
        die('Error : ' . mysqli_error());
    }
}

fclose($fp);

?>