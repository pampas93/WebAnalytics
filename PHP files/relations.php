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

$sql1 = "SELECT COUNT(*) as counter FROM urlkeys";

$result1=mysql_query($sql1);
if (!$result1) {
    echo "Could not successfully run query ($sql1) from DB: " . mysql_error();
    exit;
}

$row = mysql_fetch_array($result1); //counting number of distinct urls. for array.
$c = $row["counter"];


$a = array(); // 2D array  //Creating array to hold path counter.
for($i=0; $i<($c+1); $i++)
{
    $a[$i] = array(); // array of cells for column $i
    for($j=0; $j<($c+1); $j++)
    {
        $a[$i][$j] = 0;
    }
}

for ($i=1; $i<($c+1) ; $i++) 
{ 
    $sql2 = "SELECT * FROM table3 WHERE SessionNo=$i"; //selecting rows for each session
    $result2=mysql_query($sql2);
    if (!$result2) {
        echo "Could not successfully run query ($sql2) from DB: " . mysql_error();
    exit;
    }

    $z=0;
    $x=0;

    while($row = mysql_fetch_array($result2)) //Inserting these keys ans sessions into new table.
    {
        $z++;
        if($z==1)
        {
            $x = $row["PageKey"];
            continue;
        }

        $y = $row["PageKey"];
        $a[$x][$y]++;

        $x = $row["PageKey"];
    }

}
/*
// Printing the 2d flow matrix.
for($i=1; $i<($c+1); $i++)
{
    for($j=1; $j<($c+1); $j++)
    {
        echo $a[$i][$j]. " . ";
    }
    echo "<br>";
}

*/


$l = sizeof($a);
//echo $l;

//echo "<br>";


$bar = array(); // 2D array  //Creating array to hold path counter.
for($i=0; $i<15; $i++)
{
    $bar[$i] = array(); // array of cells for column $i
    for($j=0; $j<3; $j++)
    {
        $bar[$i][$j] = 0;
    }
}


for($j=0; $j<15; $j++)
{
    $max = -10;
    $key1 = 0;
    $key2 = 0;

    for($i=0; $i<$l; $i++)
    {
        for ($k=0; $k < $l; $k++) 
        { 
            if($a[$i][$k]>$max)
            {
                $max=$a[$i][$k];
                $key1=$i;
                $key2=$k;
            }

        }
        
    }

    $bar[$j][0] = $key1;
    $bar[$j][1] = $key2;
    $bar[$j][2] = $max;

    $a[$key1][$key2]= -100;
    //echo $b[$key];
}

    echo "<br>";
        echo "<br>";
            echo "<br>";

/*
for($i=0; $i<10; $i++)
{
    echo $bar[$i][0]. " -> ";
    echo $bar[$i][1]. " ----->> ";
    echo "<br>";
}
*/


$sql7="CREATE TABLE topLanding (
URL_From VARCHAR(100) NOT NULL,
URL_To VARCHAR(100) NOT NULL,
Hits INT(12)
)";

$result7=mysql_query($sql7);
if (!$result1) {
    echo "Could not successfully run query ($sql7) from DB: " . mysql_error();
    exit;
}


for ($i=0; $i < 15 ; $i++) 
{ 
    
    $key1 = $bar[$i][0];
    $key2 = $bar[$i][1];

    $sql9 = "SELECT DistinctURL from urlkeys where Key1 = '$key1' ";

    $result9=mysql_query($sql9);
    $x = mysql_fetch_array($result9);

    $url1 = $x['DistinctURL'];

    

    $sql9 = "SELECT DistinctURL from urlkeys where Key1 = '$key2' ";

    $result9=mysql_query($sql9);
    $x = mysql_fetch_array($result9);

    $url2 = $x['DistinctURL'];
    


    $hit = $bar[$i][2];

    $sql8 = "INSERT INTO topRelations (URL_From,URL_To,Hits) VALUES ('$url1','$url2',$hit)";
    $result8=mysql_query($sql8);
    
    echo $url1. " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo $url2. " &nbsp;&nbsp;&nbsp;&nbsp;----->>&nbsp;&nbsp;&nbsp;&nbsp; ";
    echo $hit." Hits";
    echo "<br><br>";

}

?>