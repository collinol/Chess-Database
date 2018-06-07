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

// Getting the input parameter (user):
$user = $_REQUEST['user'];
// Get the attributes of the user with the given username
$query = "select Games.game_number,P1.name as p1, P2.name as p2, P3.name as w, Games.game_type,
Games.match_id from Games inner join Player as P1
on P1.player_id = Games.white_player_id 
inner join Player as P2 on
P2.player_id = Games.black_player_id inner join Player as P3 on
P3.player_id = winner_id
where game_type like '%nglish%';";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));
// Can also check that there is only one tuple in the result
$tuple = mysqli_fetch_array($result)
  or die("this User $user not found!");
//print $query;
//print "This player <b>$user</b> has the following attributes:";

//$gametypes = array();
//$target = 'gametype_result.php'
echo "<tr>";
echo "<td>game_number</td>";
echo "<td>white_player_id</td>";
echo "<td>black_player_id</td>";
echo "<td>winner_id</td>";
echo "<td>game_type</td>";
echo "<td>match_id</td>";
//white_player_id\tblack_player_id\twinner_id\tgame_type\tmatch_id\ttournament_id\tdateOf";
echo "</tr>";

foreach($result as $gametype){
        //array_push($gametypes,$gametype);
       	echo "<tr>";
	foreach($gametype as $column){
		echo"<td>$column</td>";
	
	}
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

