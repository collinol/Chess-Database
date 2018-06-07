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
$query = "select distinct isRatedIn.year as rating_year,Player.name,Nations.name_abbrev,rating from isRatedIn inner join Player on  isRatedIn.player_id = Player.player_id inner join Nations on  Player.nation_id = Nations.nation_id  inner join (select max(rating) as mrating,year from isRatedIn group by year)A on isRatedIn.year = A.year and rating = A.mrating order by isRatedIn.year  asc ;";
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
print "Highest Ratings by Year";
echo "<tr>";
echo "<td>year</td>";
echo "<td>name</td>";
echo "<td>country</td>";
echo "<td>rating</td>";
//white_player_id\tblack_player_id\twinner_id\tgame_type\tmatch_id\ttournament_id\tdateOf";
echo "</tr>";

while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
       	echo "<tr>";
	echo"<td>".$row["rating_year"]."</td>"."<td>".$row["name"]."</td>"."<td>".$row["name_abbrev"]."</td>"."<td>".$row['rating']."</td>";
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

