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
$newTournament = $_POST['name'];
if($newTournament == ""){die("Tournament name cannot be blank");}
$testQuery = "select name from Tournaments where name = '$newTournament'";
$testResult = mysqli_query($dbcon,$testQuery);
while($row = $testResult->fetch_assoc()){
	if($newTournament == $row['name']){die("That Tournament already exists in the database");}
}

// Get the attributes of the user with the given username
$newId = "select max(tournament_id) as m from Tournaments;";
$newIdResult = mysqli_query($dbcon,$newId);
$newMax = 0;
while($row = $newIdResult->fetch_assoc()){
	$newMax = (int)$row['m'];
}
$newMax = $newMax+1;

$query = "insert into Tournaments (tournament_id,name) values($newMax,'$newTournament');";
$result = mysqli_query($dbcon, $query)
  or die('Insertion failed. Please make sure you submitted a valid name for a tournament ');


print "Tournament added successfully. Updated list <br>";

$query2 = "select * from Tournaments;";

$result_real = $dbcon->query($query2);

//$target = 'gametype_result.php'
echo "</tr>";

while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["tournament_id"]."</td>"."<td>".$row["name"]."</td>";
        echo"</tr>";
        //symlink($target,$gametype['name']);
        //echo readlink($gametype['name']);
}


// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>
</table>
</body>
<html>
 

