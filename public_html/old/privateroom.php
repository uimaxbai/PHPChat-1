<?php
 
session_start();

if ($_SESSION['loggedin'] !== TRUE) {
	header('Location: index.php');
	exit;
}
 
if(isset($_GET['logout'])){    
     
    //Simple exit message
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";
    $file = "private-".$_SESSION['chatroom'].".html";
  
    file_put_contents($file, $logout_message, FILE_APPEND | LOCK_EX);
    $_SESSION['chatroom'] = "";
    header("Location: index.php"); //Redirect the user
}
if(isset($_POST['enter'])){
    if($_POST['chatroom'] != ""){
        $_SESSION['chatroom'] = intval(stripslashes(htmlspecialchars($_POST['chatroom'])));
    }
    else{
        echo '<span class="error">Please type in a chatroom</span>';
    }
} 
function loginForm(){
    echo
    '<div id="loginform">
    <h1>Please enter a chаtroom to continue!</h1>
    <form action="privateauth.php" method="post">
    <div class="chatroom">
      <label for="chatroom">Chаtroom &mdash;</label>
      <input type="number" name="chatroom" id="chatroom" required/>
     </div>
     <div class="password-private">
      <label for="password">Password <div class="help"><i class="fa fa-question-circle" aria-hidden="true" style="color: #0000ff;"></i> &mdash;</label>
      <div class="help-box">
          <span>If that chatroom has not yet been registered, the password typed in will be the password you will use to enter the chatroom.</span>
      </div>
      </div>
      <input type="password" name="password" id="password" required/>
      <input type="submit" name="enter" id="enter" value="Enter" />
      </div>
    </form>
  ';
}

?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
 
      <title>Private Chаtrooms <?php echo $_POST['chatroom']?></title>
      
      <script src="https://kit.fontawesome.com/049529442a.js" crossorigin="anonymous"></script>
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
        .help-box {
            display: none;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            position: absolute;
            background: white;
            width: 160px;
            z-index: 1;
        }
        .chatroom {
            margin: auto;
        }
        .password-private {
            display: block;
            margin: auto;
        }
      .help:hover .help-box {
          display: block;
      }
    </style>


        <meta name="description" content="PHPChat: A no-faff simple chаtroom" />
        <link rel="stylesheet" href="style.css?v=4" />
    </head>
    <body>
        <div class="logout">
      <a href="logout.php"><i class="fas fa-sign-out-alt" ></i> Logout</a>
</div>
      <a href="https://phpchat.ml">
         <img alt="Qries" src="logo.png" class="logo/" height="170" onclick="location.href='/index.php';">
      </a>
      <h1>Private chatrooms: Chatroom 
      <?php
      if ($_SESSION['chatroom']) {
          echo '- code ' . $_SESSION['chatroom'];
      }
      ?></h1>
    <?php
    if(!isset($_SESSION['chatroom']) || $_SESSION['chatroom'] == ""){
        loginForm();
    }
    else {
    ?>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b> to chаtroom <b><?php echo $_SESSION['chatroom']; ?></b></p>
               <a id="exit" class="exit" href="privateroom.php?logout=true">Exit Chаt</a>
            </div>
 
            <div id="chatbox">
            <?php
            if(file_exists("private-".$_SESSION['chatroom'].".html") && filesize("private".$_SESSION['chatroom'].".html") > 0){
                $contents = file_get_contents("private-".$_SESSION['chatroom'].".html");          
                echo $contents;
            }
            ?>
            </div>
 
            <form name="message" action="postmsg.php">
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
                    $.post("postprivate.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });
 
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
 
                    $.ajax({
                        url: "private-"+<?php  echo $_SESSION['chatroom']; ?>+".html",
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
                    window.location = "privateroom.php?logout=true";
                    }
                });
            });
        </script>
    </body>
</html>
<?php
}
?>
<a href="https://phpchat.ml/privacy-policy.html"><br>Privacy Policy •</a>
    <a href="/chat.php">Main Chat <br><br></a>

<button class="button" align="center" onclick="location.href='/index.php';"><span>Go back home!</span></button>