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
$query = "select Games.game_number,P1.name as p1, P2.name as p2, P3.name as w, Games.game_type,
Games.match_id, Games.dateOf from Games inner join Player as P1
on P1.player_id = Games.white_player_id 
inner join Player as P2 on
P2.player_id = Games.black_player_id inner join Player as P3 on
P3.player_id = winner_id
where Games.dateOf = $number;";




$result_real = $dbcon->query($query)
or die('Query failed: ' . mysqli_error($dbcon)."<br>Please only enter the last two digits of the year");
//$tuple = mysqli_fetch_array($result)
  //or die("year $number not valid! - Please only enter the last two digits of the year");


print "Games Played in  $number";
echo "<br>";
print "if table is empty, make sure you only entered the last two digits of the year";
echo "<tr>";
echo "<td>game number</td>";
echo "<td>Player 1</td>";
echo "<td>Player 2</td>";
echo "<td>Winner </td>";
echo "<td>Game Type</td>";
echo "<td>Match id</td>";
echo "<td>Year </td>";

echo "</tr>";

while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["game_number"]."</td>"."<td>".$row["p1"]."</td>"."<td>".$row["p2"]."</td>"."<td>".$row["w"]."</td>"."<td>".$row["game_type"]."</td>"."<td>".$row["match_id"]."</td>"."<td>".$row["dateOf"]."</td>";
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
 

