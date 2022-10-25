<!DOCTYPE html>
<html>
  <head>
    <meta name="robots" content="noindex">
  </head>
  <body><?php
$servername = "remotemysql.com";
$username = "HrgYVrvJPY";
$password = "QbuimZiq0O";
$dbname = "HrgYVrvJPY";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "The time is " . date("H:i:sa");

?>

<button type="submit" onclick="location.href='/index.php';">Go back home</button>
  </body>
  
</html>