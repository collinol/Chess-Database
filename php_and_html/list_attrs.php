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
$user = $_REQUEST['user'];

// Get the attributes of the user with the given username
$query = "SELECT * FROM Player WHERE name = '$user'";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));
// Can also check that there is only one tuple in the result
$tuple = mysqli_fetch_array($result)
  or die("this User $user not found!");
//print $query;
print "This player <b>$user</b> has the following attributes:";

// Printing user attributes in HTML
print '<ul>';  
print '<li> id: '.$tuple['player_id'];
print '<li> Full name: '.$tuple['name'];
print '<li> nation_id: '.$tuple['nation_id'];
print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 

