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
$number = $_REQUEST['user'];

// Get the attributes of the user with the given username
$query = "select name,count(name) as total_wins from Player inner join Games
on Player.player_id = Games.winner_id group by name
having total_wins > $number;";

$result_real = $dbcon->query($query);

//$target = 'gametype_result.php'
print "Players who have won more than $number games";
echo "<tr>";
echo "<td>name</td>";
echo "<td>total wins</td>";


echo "</tr>";

while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["name"]."</td>"."<td>".$row["total_wins"]."</td>";
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
 

