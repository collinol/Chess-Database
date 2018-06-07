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
$procedure = $_POST['procedure'];
print "Result of Procedure: <br>";
if($procedure == "Population Relativity"){
	
	$query = "call PopulationRelativity()";	
	$dbcon->query($query);
	$query2 = "select name_abbrev as Country, round(rel_pop,5) as Relative_Population from Relative_Populations;";

	$result_real = $dbcon->query($query2);
	echo "</tr>";

	while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["Country"]."</td>"."<td>".$row["Relative_Population"]."</td>";
        echo"</tr>";
        
	}


}
if($procedure == "Get Players"){

        $query = "call GetPlayers()";
        $result_real = $dbcon->query($query);
        echo "</tr>";

        while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["player_id"]."</td>"."<td>".$row["name"]."</td";
        echo"</tr>";

        }


}
if($procedure =="Show Views"){

        $query = "call ShowAllViews()";
        $result_real = $dbcon->query($query);
        echo "</tr>";

        while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["TABLE_SCHEMA"]."</td>"."<td>".$row["TABLE_NAME"]."</td>"
	."<td>".$row["TABLE_TYPE"]."</td>";
        echo"</tr>";

        }


}


// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>
</table>
</body>
<html>
 

