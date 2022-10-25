
<html>
<head></head>
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id19613881_gonerogue');
define('DB_PASSWORD', 'GV-PHQ0juIxqN7AD');
define('DB_NAME', 'id19613881_goneroguedb');
// Create connection
$conn = new mysqli($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_NAME);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Name FROM Logins";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "row[\"Name\"]". "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>