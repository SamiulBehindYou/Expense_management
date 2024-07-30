<?php
session_start();
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'creativedb';
$conn = mysqli_connect($hostname, $username, $password, $db_name);

// Print the array from getdate()
print_r(getdate());
echo "<br><br>";

// Return date/time info of a timestamp; then format the output
$mydate=getdate(date("U"));
echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";



echo 'test';

?>