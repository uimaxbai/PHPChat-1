<?php
session_start();
if ($_SESSION['loggedin'] !== TRUE) {
	header('Location: index.php');
	exit;
}
else {
    session_destroy();
    header('Location: index.php');
	exit;
}
?>