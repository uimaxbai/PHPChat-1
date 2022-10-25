<?php
 
session_start();

if ($_SESSION['loggedin'] !== TRUE) {
	header('Location: index.php');
	exit;
}
 
if(isset($_GET['logout'])){    
     
    //Simple exit message
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";
    file_put_contents("log".$_SESSION['chatroom'].".html", $logout_message, FILE_APPEND | LOCK_EX);
     
    header("Location: index.php"); //Redirect the user
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
 
      <title>PHPChat</title>
      
      <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
      <link rel="manifest" href="/site.webmanifest">
      <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
      <meta name="msapplication-TileColor" content="#2d89ef">
      <meta name="theme-color" content="#ffffff">
      <style>
      .logout {
        position: relative;
        margin-right: 5px;
      }
      .logout a {
        position: absolute;
        top: 0;
        right: 0;
      }
      @media (prefers-color-scheme: dark) {
          .loginform {
            background: #333;
          }
          .wrapper {
            background: #333;
          }
          body {
            background: #444;
          }
}
    </style>


        <meta name="description" content="PHPChаt: A no-faff simple chаtroom" />
        <link rel="stylesheet" href="style.css?v=3" />
    </head>
    <body>
        <div class="logout">
      <a href="logout.php"><i class="fas fa-sign-out-alt" ></i> Logout</a>
</div>
      <a href="https://phpchat.ga">
         <img alt="Qries" src="logo.png" class="logo/" height="170" onclick="location.href='/index.php';">
      </a>
      <h1>Chatroom 2 (Secondary/<a href="https://www.urbandictionary.com/define.php?term=NSFW">NSFW</a> Chаtroom)</h1>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
                <a id="exit" class="exit" href="privateroom.php?logout=true">Exit Chаt</a>
            </div>
 
            <div id="chatbox">
            <?php
            if(file_exists("log2.html") && filesize("log2.html") > 0){
                $contents = file_get_contents("log2.html");          
                echo $contents;
            }
            ?>
            </div>
 
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>
        </div>
      
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post2.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });
 
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
 
                    $.ajax({
                        url: "log2.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }
 
                setInterval (loadLog, 2500);
 
                $("#exit").click(function () {
                    var exit = confirm("Are you sure you want to end the session?");
                    if (exit == true) {
                    window.location = "chat2.php?logout=true";
                    }
                });
            });
        </script>
    </body>
</html>
<a href="https://phpchat.ml/privacy-policy.html"><br>Privacy Policy •</a>
    <a href="/chat.php">Main Chat <br><br></a>

<button class="button" align="center" onclick="location.href='/index.php';"><span>Go back home!</span></button>