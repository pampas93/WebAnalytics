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

$landing = array();             //Creating array to hold landing page counter.
for($i=0; $i<($c+1); $i++)
{
    $landing[$i] = 0; 
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
            $landing[$x]++;
            continue;
        }

        $y = $row["PageKey"];
        $a[$x][$y]++;

        $x = $row["PageKey"];
    }

}
for($i=1; $i<($c+1); $i++)
{
    echo $landing[$i]. " . " ;
}
echo "<br>";
echo "<br>";

for($i=1; $i<($c+1); $i++)
{
    for($j=1; $j<($c+1); $j++)
    {
        echo $a[$i][$j]. " . ";
    }
    echo "<br>";
}

//---------------------------------------------------------

$b = array();
$b = $landing;

$l = sizeof($b);
echo $l;

echo "<br>";


$bar = array(); // 2D array  //Creating array to hold path counter.
for($i=0; $i<10; $i++)
{
    $bar[$i] = array(); // array of cells for column $i
    for($j=0; $j<2; $j++)
    {
        $bar[$i][$j] = 0;
    }
}


for($j=0; $j<10; $j++)
{
    $max = -10;
    $key = 0;

    for($i=1; $i<$l; $i++)
    {
        if($b[$i]>$max)
        {
            $max=$b[$i];
            $key=$i;
        }
    }

    $bar[$j][0] = $key;
    $bar[$j][1] = $max;

    $b[$key]= -100;
    //echo $b[$key];
}

    echo "<br>";
        echo "<br>";
            echo "<br>";


for($i=0; $i<10; $i++)
{
    for($j=0; $j<2; $j++)
    {
        echo $bar[$i][$j]. " -> ";
    }
    echo "<br>";
}


$sql7="CREATE TABLE topLanding (
URL VARCHAR(100) NOT NULL,
Hits INT(12)
)";

$result7=mysql_query($sql7);
if (!$result1) {
    echo "Could not successfully run query ($sql7) from DB: " . mysql_error();
    exit;
}



for ($i=0; $i < 10 ; $i++) 
{ 
    
    $key = $bar[$i][0];

    $sql9 = "SELECT DistinctURL from urlkeys where Key1 = '$key' ";

    $result9=mysql_query($sql9);
    $x = mysql_fetch_array($result9);

    $url = $x['DistinctURL'];
    $hit = $bar[$i][1];

    $sql8 = "INSERT INTO topLanding (URL,Hits) VALUES ('$url', $hit)";
    $result8=mysql_query($sql8);
    

    //echo $url;
    //echo "<br>";

    //$val = $url;
    //$hit = $bar[$i][1];
    //$data[] = [$val, (int)$hit];

}

//json_encode($data);

//echo json_encode($data);

include '/visitorCount.php';

?>