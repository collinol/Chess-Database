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
$query = "select name_abbrev,count(name) as total from Player inner join Nations on Player.nation_id = Nations.nation_id group by name_abbrev;";


$result_real = $dbcon->query($query);

//$target = 'gametype_result.php'
print "Countries and Number of players";
echo "<tr>";
echo "<td>Country</td>";
echo "<td>Total Players in Database</td>";


echo "</tr>";

while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
       	echo "<tr>";
	echo"<td>".$row["name_abbrev"]."</td>"."<td>".$row["total"]."</td>";
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

