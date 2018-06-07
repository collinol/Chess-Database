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
// Get the attributes of the user with the given username

$query = "select nation_id, name_abbrev from Nations;";


$result_real = $dbcon->query($query);
while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["nation_id"]."</td>"."<td>".$row["name_abbrev"]."</td>";
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
 

