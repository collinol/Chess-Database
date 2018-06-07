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
$year = $_POST['year'];
$name  = $_POST['name'];
$rating = $_POST['rating'];
$testQuery = "select name from Player where name = '$name'";
$testResult = mysqli_query($dbcon,$testQuery) or die("player not found");
if(mysqli_num_rows($testResult)==0 ){
	die("Please make sure you submitted a valid entry for the player's name.<br>
See 'Current Ratings' for valid names");
}
$query = "update isRatedIn set rating = $rating where year = $year 
and player_id = (select player_id from Player
where name = '$name');";
$result = mysqli_query($dbcon, $query)
  or die("Update failed. Please make sure you submitted a valid entry for the player's name.\n
See 'Current Ratings' for valid names");


print "Ratings updated successfully.<br>";
print "Here's a sample of the updated list <br>";
$substring = substr($name, 1, 3);
$query2 = "select year,name,rating from isRatedIn inner join
Player on isRatedIn.player_id = Player.player_id where name like '%$substring%';";

$result_real = $dbcon->query($query2);

//$target = 'gametype_result.php'
echo "</tr>";

while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["year"]."</td>"."<td>".$row["name"]."</td>"."<td>".$row["rating"];
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
 

