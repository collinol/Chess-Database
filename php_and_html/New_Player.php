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
$newPlayer = $_POST['user'];
$country  = $_POST['country'];
// Get the attributes of the user with the given username
$check = "select * from BackUpNations where nation_id = $country";
$checkResult = mysqli_query($dbcon,$query);
if(mysqli_num_rows($checkResult)==0 ){
        die("That Nation Id does not exist. Please refer to Country Codes for existing nations");
}



$query = "insert into Player (name,nation_id) values('$newPlayer',$country);";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

print "Player added successfully. Updated list <br>";

$query2 = "select player_id, name, name_abbrev from Player inner join
Nations on Player.nation_id = Nations.nation_id order by player_id desc;";
$result_real = $dbcon->query($query2);

//$target = 'gametype_result.php'
echo "</tr>";

while($row = $result_real->fetch_assoc()){
        //array_push($gametypes,$gametype);
        echo "<tr>";
        echo"<td>".$row["player_id"]."</td>"."<td>".$row["name"]."</td>"."<td>".$row["name_abbrev"];
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
 

