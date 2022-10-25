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
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if ( !isset($_POST['chatroom'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the chatroom and password fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT chatroom, password FROM PCPass WHERE chatroom = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['chatroom']);
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
      $_SESSION['chatroom'] = $_POST['chatroom'];
      $_SESSION['id'] = $id;
      header("Location: newinterface.php");
    } else {
      // Incorrect password
      echo 'Incorrect chatroom and/or password!';
    }
  } else {
    // Register the chatroom
    if ($stmt = $con->prepare('SELECT chatroom, password FROM PCPass WHERE chatroom = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
        $stmt->bind_param('s', $_POST['chatroom']);
        $stmt->execute();
        $stmt->store_result();
        // Store the result so we can check if the account exists in the database.
        if ($stmt->num_rows > 0) {
            // Username already exists
            exit('Error occured... please try again later.');
        } else {
            if ($stmt = $con->prepare('INSERT INTO PCPass (Chatroom, Password) VALUES (?, ?)')) {
                // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('is', intval($_POST['chatroom']), $password);
                $stmt->execute();
                echo 'You have successfully registered, you can now login!';
                header("Location: newinterface.php");
            } else {
                // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                echo 'Could not prepare statement!';
            }
        }
        $stmt->close();
    } else {
        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
        echo 'Could not prepare statement!';
    }
    $con->close();
  }


	$stmt->close();
}
?>