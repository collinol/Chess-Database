<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>
<table align="center" border ="1" cellpadding = "3" cellspacing = "0">
<?php

// Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'collinol';
$password = '1019Mysq!';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
// Getting the input parameter (user):
$view = $_POST['view'];
$query = "drop view if exists $view;";
$result = mysqli_query($dbcon, $query)
  or die("Invalid entry for view");

print "Remaing Views <br>";


$query2 = "call ShowAllViews()";
        $result_real = $dbcon->query($query2);
        echo "</tr>";

        while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["TABLE_SCHEMA"]."</td>"."<td>".$row["TABLE_NAME"]."</td>"
        ."<td>".$row["TABLE_TYPE"]."</td>";
        echo"</tr>";

        }

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>
</table>
</body>
<html>
 

