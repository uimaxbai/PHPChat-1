<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'hallo');
define('DB_PASSWORD', 'why you looking');
define('DB_NAME', 'lol');
 
/* Attempt to connect to MySQL database */
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else {
    echo 'connected';
}
?>


