<?php
session_start();
// Change this to your connection info.
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id19613881_gonerogue');
define('DB_PASSWORD', 'GV-PHQ0juIxqN7AD');
define('DB_NAME', 'id19613881_goneroguedb');
// Try and connect using the info above.
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	$_SESSION['error'] = 'Internal error. Please reload and try again.';
	header("Location: index.php");
	exit;
}
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	$_SESSION['error'] = 'Please fill in both fields!';
	header("Location: index.php");
	exit;
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT name, password FROM Logins WHERE name = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $password);
    $stmt->fetch();
    // Account exists, now we verify the password.
    // Note: remember to use password_hash in your registration file to store the hashed passwords.
    if (password_verify($_POST['password'], $password)) {
      // Verification success! User has logged-in!
      // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
      session_regenerate_id();
      $_SESSION['loggedin'] = TRUE;
      $_SESSION['name'] = $_POST['username'];
      $_SESSION['id'] = $id;
      $_SESSION['error'] = "";
      header("Location: newinterface.php");
    } else {
      // Incorrect password
      $_SESSION['error'] = 'Incorrect username and/or password!';
      header("Location: index.php");
	  exit;
    }
  } else {
    // Incorrect username
    $_SESSION['error'] = 'Incorrect username and/or password!';
    header("Location: index.php");
	exit;
  }


	$stmt->close();
}
?>