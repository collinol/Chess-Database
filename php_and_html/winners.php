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
//print 'Connected successfully!<br>';


// Get the attributes of the user with the given username
$query = "select Tournaments.name as t_name,dateOf,Player.name from PlaysAgainstIn inner join Matches
on Matches.match_id = PlaysAgainstIn.match_id
inner join Player on winner_id = player_id
inner join Tournaments on Matches.tournament_id = Tournaments.tournament_id
where Matches.match_id like '7-%-%-%' order by dateOf desc;";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));
$result_real = $dbcon->query($query);

// Can also check that there is only one tuple in the result
$tuple = mysqli_fetch_array($result)
  or die("this User $user not found!");
//print $query;
//print "This player <b>$user</b> has the following attributes:";

//$gametypes = array();
//$target = 'gametype_result.php'
print Winners;
echo "<tr>";
echo "<td>Tournament</td>";
echo "<td>Year</td>";
echo "<td>Winner</td>";
//white_player_id\tblack_player_id\twinner_id\tgame_type\tmatch_id\ttournament_id\tdateOf";
echo "</tr>";

while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
       	echo "<tr>";
	echo"<td>".$row["t_name"]."</td>"."<td>".$row["dateOf"]."</td>"."<td>".$row["name"]."</td>";
	echo"</tr>";
        //symlink($target,$gametype['name']);
        //echo readlink($gametype['name']);
}
//foreach($gametypes as $name){
//print_r($name);
//print '<br>';
//}
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>
</table>
</body>
<html>

