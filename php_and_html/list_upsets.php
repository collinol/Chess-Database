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
$query = "select match_id,r1,r2,wr from (
select distinct Games.game_number,Games.white_player_id as p1, Games.black_player_id as p2, Games.winner_id as w, Games.game_type,
Games.match_id,R1.rating as r1, R2.rating as r2, R3.rating as wr from Games 
inner join isRatedIn as R1 on 
R1.player_id = Games.white_player_id
inner join isRatedIn as R2 on
R2.player_id = Games.black_player_id 
inner join isRatedIn as R3 on
R3.player_id = Games.winner_id 
inner join Matches on Games.match_id = Matches.match_id
where R1.year = Matches.dateOf 
and R2.year = Matches.dateOf
and R3.year = Matches.dateOf
) A
where (A.wr != A.r1 and (A.wr-A.r1) < -500) or (A.wr != A.r2 and (A.wr-A.r2) < -500);";
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
print "All Upsets";
echo "<tr>";
echo "<td>match_id</td>";
echo "<td>player 1 rating</td>";
echo "<td>player 2 rating</td>";
echo "<td>winner's rating</td>";
//white_player_id\tblack_player_id\twinner_id\tgame_type\tmatch_id\ttournament_id\tdateOf";
echo "</tr>";

while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
       	echo "<tr>";
	echo"<td>".$row["match_id"]."</td>"."<td>".$row["r1"]."</td>"."<td>".$row["r2"]."</td>"."<td>".$row['wr']."</td>";
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

