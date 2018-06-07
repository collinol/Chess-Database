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
$newId = $_POST['id'];
$newName  = $_POST['name'];
$newNotation = $_POST['name2'];

$testQuery = "select name, notation from GameTypes 
where notation = '$newNotation' or name = '$newName'";

$testResult = mysqli_query($dbcon,$testQuery);
while($row =  $testResult->fetch_assoc()){
	if ($newNotation == $row['notation']){
		die("A game type with this notation already exists");
	}
	if($newName == $row['name']){
		die("A game type with this name already exists");
	}
}

$query = "insert into GameTypes (game_type_id,name,notation) 
values('$newId','$newName','$newNotation');";

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

print "new Game Type added!<br>";
print "$newId | $newName | $newNotation <br>";

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>
</table>
</body>
<html>
 

