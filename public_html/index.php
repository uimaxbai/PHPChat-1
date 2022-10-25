<?php
session_start();
if ($_SESSION['loggedin'] == TRUE) {
	header('Location: newinterface.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
    <meta charset="utf-8" />
    <meta name="description" content="PHPChat: A no-faff simple chatroom" />
    <link type="text/css" rel="stylesheet" href="/style.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://kit.fontawesome.com/049529442a.js" crossorigin="anonymous"></script>
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <style>
      .loginform {
        margin: 0 auto;
        padding: 25px;
        background: #eee;
        width: 600px;
        max-width: 100%;
        border: 2px solid #0000ff;
        border-radius: 4px;
      }
      .field {
          border: 2px solid #0000ff;
          border-radius: 4px;
          margin-left: auto;
          margin-right: auto;
          height: 25px;
      }
      @media (prefers-color-scheme: dark) {
        .loginform {
          background: #333;
        }
        body {
          background: #444;
          color: white;
        }
      }
      .submit {
        height: 25px;
        text-align: center;
        background: #0000ff;
        border: 2px solid #0000ff;
        border-radius: 4px;
        color: white;
      }
      .submit:hover {
        background: white;
        color: black;
        cursor: pointer;
      }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
  <img src="/logo.png" style="display: block; margin-left: auto; margin-right: auto; height: 75px; margin-bottom: 25px; margin-top: 25px; height: 125px;">
		<div class="loginform">
      
			<h1 style="margin: 0;" >Login</h1>
			<?php
			if (isset($_SESSION['error']) && $_SESSION['error'] !== "") {
			    echo '<span class="error">' . $_SESSION['error'] . '</span>';
			}
			?>
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input class="field" type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input class="field" type="password" name="password" placeholder="Password" id="password" required>
				<input class="submit" type="submit" value="Login">
			</form>
            <p>By clicking 'Login', you are accepting that we <a href="\cookies.html">use cookies</a>.<i class="fa-thin fa-cookie-bite fa-pull-right fa-2x"></i></p>
		</div>
		<p>No account? Register <a href="https://gonerogue.ml/register.php">here</a>!</p>
	</body>
</html>