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
$country = $_POST['country'];
$query = "delete from BackUpNations where name_abbrev = '$country'";
$result = mysqli_query($dbcon, $query)
  or die("Update failed. Please make sure you submitted a valid entry for the player's name.\n
See 'Current Ratings' for valid names");

$query2 = "select * from BackUpNations;";

$result_real = $dbcon->query($query2);

//$target = 'gametype_result.php'
echo "</tr>";

while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["nation_id"]."</td>"."<td>".$row["name_abbrev"]."</td>"."<td>".$row["population"];
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
 

