<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id19613881_gonerogue');
define('DB_PASSWORD', 'GV-PHQ0juIxqN7AD');
define('DB_NAME', 'id19613881_goneroguedb');
 
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


