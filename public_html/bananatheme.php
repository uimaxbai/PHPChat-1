<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit;
}
if (strval($_GET['logout']) == "2") {
    $_SESSION['chatroom'] = "";
    header("Location: newinterface.php?s=3");
    exit;
}
else if (strval($_GET['logout']) == "1") {
    session_destroy();
    header("Location: index.php");
    exit;
}

$spam = false;
if ($_SESSION['theme'] == false) {
        echo '<style>
            body {
                background: #333; 
                color: white;
                
            }
            </style>';
}
if ($_SESSION['theme'] == true) {
    echo '<style>
            body {
                background: white; 
                color: black;
                
            }
            </style>';
}
function checkforThemeChange() {
    if(strval($_GET['themeChange']) == "true") {
        if (!isset($_SESSION['theme'])) {
            $_SESSION['theme'] = false; // true is light
        }
        if ($_SESSION['theme'] == true) {
            $_SESSION['theme'] = false;
            echo '<style>
            body {
                background: #333; 
                color: white;
                
            }
            </style>';
        }
        else if ($_SESSION['theme'] == false) {
            $_SESSION['theme'] = true;
            echo '<style>body {
                    background: white; 
                    color: black;
            }
                </style>';
        }
    }
}


    if (isset($_POST['usermsg'])) {
        $service = strval($_GET['s']) or $service = $_SESSION['service'];
        
        $text = $_POST['usermsg'];
        if (strlen($text) > 32) {
            $text = "Text too long!";
        }
        $_SESSION['messages'] = $_SESSION['messages'] + 1;
        if (isset($_SESSION['lastmessage'])) {
            $nowtime = time();
            $difference = $nowtime - $_SESSION['lastmessage'];
            if ($difference < 3) {
                $spam = true;
            }
            else {
                $b1 = "porn";
        $b2 = "sex";
        $b3 = "shit";
        $b4 = "fuck";
        $b5 = "piss";
        $b6 = "dick";
        $b7 = "ass";
        $b8 = "bitch";
        $b9 = "bastard";
        $b10 = "cunt";
        $b11 = "bollock";
        $b12 = "blood";
        $b13 = "shag";
        $b18 = "p0rn";
        // $b17 = "trash";
        // $b16 = "rubbish";
        $b14 = "twat";
        $b15 = "stuffed";
        $btest = "filtertest";
        if (stripos($text, $b1) !== FALSE || stripos($text, $b2) !== FALSE || stripos($text, $b3) !== FALSE || stripos($text, $b4) !== FALSE || stripos($text, $b5) !== FALSE || stripos($text, $b6) !== FALSE || stripos($text, $b7) !== FALSE || stripos($text, $b8) !== FALSE || stripos($text, $b9) !== FALSE || stripos($text, $b10) !== FALSE || stripos($text, $b11) !== FALSE || stripos($text, $b12) !== FALSE || stripos($text, $b13) !== FALSE || stripos($text, $b14) !== FALSE || stripos($text, $b15) !== FALSE || stripos($text, $btest) !== FALSE || stripos($text, $b18) !== FALSE) {
            if ($service == "1") {
                $text = "!?*@$;!";
            }
        }

        $text_message = "<div class='msgln'><span class='chat-time'>" . date("d/m g:i A") . "</span> <b class='user-name'>" . $_SESSION['name'] . "</b> " . stripslashes(htmlspecialchars($text)) . "<br></div>";
        file_put_contents($_SESSION['file'], $text_message, FILE_APPEND | LOCK_EX);
        $_SESSION['lastmessage'] = time();
            }
        }
        else {
            $b1 = "porn";
        $b2 = "sex";
        $b3 = "shit";
        $b4 = "fuck";
        $b5 = "piss";
        $b6 = "dick";
        $b7 = "ass";
        $b8 = "bitch";
        $b9 = "bastard";
        $b10 = "cunt";
        $b11 = "bollock";
        $b12 = "blood";
        $b13 = "shag";
        $b18 = "p0rn";
        // $b17 = "trash";
        // $b16 = "rubbish";
        $b14 = "twat";
        $b15 = "stuffed";
        $btest = "filtertest";
        if (stripos($text, $b1) !== FALSE || stripos($text, $b2) !== FALSE || stripos($text, $b3) !== FALSE || stripos($text, $b4) !== FALSE || stripos($text, $b5) !== FALSE || stripos($text, $b6) !== FALSE || stripos($text, $b7) !== FALSE || stripos($text, $b8) !== FALSE || stripos($text, $b9) !== FALSE || stripos($text, $b10) !== FALSE || stripos($text, $b11) !== FALSE || stripos($text, $b12) !== FALSE || stripos($text, $b13) !== FALSE || stripos($text, $b14) !== FALSE || stripos($text, $b15) !== FALSE || stripos($text, $btest) !== FALSE || stripos($text, $b18) !== FALSE) {
            if ($service == "1") {
                $text = "!?*@$;!";
            }
        }

        $text_message = "<div class='msgln'><span class='chat-time'>" . date("d/m g:i A") . "</span> <b class='user-name'>" . $_SESSION['name'] . "</b> " . stripslashes(htmlspecialchars($text)) . "<br></div>";
        file_put_contents($_SESSION['file'], $text_message, FILE_APPEND | LOCK_EX);
        $_SESSION['lastmessage'] = time();
        }
        
    }
    function displayContent() {
        $service = strval($_GET['s']) or $service = $_SESSION['service'];
        if ($service == "1") {
            if (file_exists("log.html") && filesize("log.html") > 0) {
                $contents = file_get_contents("log.html");
                echo $contents;
                echo '</div><form class="messages" name="message" action="newinterface.php" method="post">
                <a class="scrollDown" onclick="window.scrollTo(0,document.body.scrollHeight);"><i class="fa-solid fa-circle-arrow-down fa-fw"></i></a><input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
                <img src="bananas.gif" alt="banana">'
            </form>
            ';
                $_SESSION['service'] = "1";
                $_SESSION['file'] = "log.html";
            }
        }
        if ($service == "2") {
            if (file_exists("log2.html") && filesize("log2.html") > 0) {
                $contents = file_get_contents("log2.html");
                echo $contents;
                echo '</div><form enctype="multipart/form-data" class="messages" name="message" action="newinterface.php" method="post"><a class="scrollDown" onclick="window.scrollTo(0,document.body.scrollHeight);"><i class="fa-solid fa-circle-arrow-down fa-fw"></i></a>
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>
            <img src="bananas.gif" alt="banana">';
                $_SESSION['service'] = "2";
                $_SESSION['file'] = "log2.html";
            }
        }
        if ($service == "3") {
            if (isset($_SESSION['chatroom']) && $_SESSION['chatroom'] !== "") {
                $_SESSION['file'] = "private-" . $_SESSION['chatroom'] . ".html";
                if (file_exists($_SESSION['file']) && filesize($_SESSION['file']) > 0) {
                    $contents = file_get_contents($_SESSION['file']);
                    echo $contents;
                    echo '</div><form class="messages" name="message" action="newinterface.php" method="post"><a class="scrollDown" onclick="window.scrollTo(0,document.body.scrollHeight);"><i class="fa-solid fa-circle-arrow-down fa-fw"></i></a>
                    <input name="usermsg" type="text" id="usermsg" />
                    <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
                </form>
                <img src="bananas.gif" alt="banana">';
                    $_SESSION['service'] = "3";
                }
            } else {
                $_SESSION['service'] = "3";
                echo '<h1 style="text-align: center;">Please enter a chаtroom to continue!</h1>
    <form action="privateauth.php" method="post" class="private" class="loginform">
    <img src="bananas.gif" alt="banana">;
    <div class="chatroom">
      <label for="chatroom">Chаtroom &mdash;</label>
      <input type="number" name="chatroom" id="chatroom" required/>
     </div>
     <div class="password-private">
      <label for="password">Password &mdash;</label>
      <input type="password" name="password" id="password" required/>
      <input type="submit" name="enter" id="enter" value="Enter" />
      </div>
    </form>
    
            }
        }
        if ($service == "4") {
            echo '<style>body {background-image: linear-gradient(45deg, rgb(0, 0, 255), white); }</style><p>work in progresh</p>
            <div class="icons"><i class="fa-light fa-flask fa-10x fa-bounce"></i><i class="fa-light fa-vials fa-10x fa-bounce"></i><img src="\wip_joke.png"></img></div>';
            /*echo '<form class="loginform">
        <div id="loginform">
            <h1>Please enter a user to continue!</h1>
            <form action="send_dm.php" method="post">
                <div class="chatroom">
                    <label for="chatroom">User &mdash;</label>
                    <input type="text" name="chatroom" id="chatroom" required/>
                </div>
                <div class="password-private">
                    <label for="password">Message &mdash;</label
                </div>
                <input type="text" name="password" id="password" required/>
                <input type="submit" name="enter" id="enter" value="Enter" />
        </div>
    </form>
    

    <div id="wrapper" style="display: block; margin-top: 50px; position: absolute; left: 18.5% !important;">
        <div id="menu">
            <p class="welcome">Welcome <b>to your messages</b></p>
            <a id="exit" class="exit" href="privateroom.php?logout=true">Exit Chаt</a>
            <img src="bananas.gif" alt="banana">'
        </div>

        <div id="chatbox">
            <?php
            if(file_exists($_SESSION['name'].".html") && filesize($_SESSION['name'].".html") > 0){
                $contents = file_get_contents($_SESSION['name'].".html");
                echo $contents;
            }
            ?>
        </div>
        <img src="bananas.gif" alt="banana">
    </div>';*/
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://kit.fontawesome.com/049529442a.js" crossorigin="anonymous"></script>
        <title>PHPChаt: chat without the faff</title>
          <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
          <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
          <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
          <link rel="manifest" href="/site.webmanifest">
          <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
          <meta name="msapplication-TileColor" content="#2d89ef">
          <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="banana.css>
        <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width, height=device-height, target-densitydpi=device-dpi">
        <style>
            .icons {
                vertical-align: center;
            }
            @media only screen and (min-height: 1024px) {
                .icons {
                    margin-top: 100px;
                }
            }
        .scrollDown {
            height: 25px;
            cursor: pointer;
        }
            .help-box {
                display: none;
            }

				.option {
					padding-top: 50%;
					text-align: center;
				}
            .sidenav {
              height: 100%;
              width: 160px;
              position: fixed;
              z-index: 1;
              top: 0;
              left: 0;
              background-color: #ebebeb;
              border-right: 1px solid #888888;
              overflow-x: hidden;
              padding-top: 20px;
              display: none;
            }
            .sidenav-mobile {
              position: fixed;
              z-index: 1;
              top: 0;
              left: 0;
              background-color: #ebebeb;
              border-right: 1px solid #888888;
              overflow-y: hidden;
              display: none;
              width: 100%;
            }
            @media only screen and (min-width:768px) {
                .sidenav {
                    display: inline;
                }
                .main {
                    width: 100%;
                }
            }
            
            .sidenav-mobile a {
              padding: 6px 12px 6px 12px;
              text-decoration: none;
              font-size: 25px;
              color: black;
              vertical-align: center;  
            }
            .sidenav a {
              padding: 6px 16px 6px 16px;
              text-decoration: none;
              font-size: 25px;
              color: black;
              display: block;
              vertical-align: center;
            }
            
            .sidenav a:hover {
              color: white;
              background: #0000ff;
            }
            
            .main {
              margin-left: 160px; /* Same as the width of the sidenav */
              font-size: 28px; /* Increased text to enable scrolling */
            text-align: left;
            padding: 0px 10px 0px 24px;
            
            }
            @media screen and (max-height: 450px) {
              .sidenav {padding-top: 15px;}
              .sidenav a {font-size: 18px;}
            }
            .messages {
                background: #ebebeb;
                margin-top: 20px;
                margin-left: 160px;
                position: sticky;
                position: -webkit-sticky;
                box-shadow: 0 0 0 0;
                    bottom: 0;
                    left: 0;
                    border-radius: 0px;
            }
            @media only screen and (max-width:767px) {
                .sidenav-mobile {
                    display: inline;
                }
                .main {
                    margin-left: 0;
                }
                .messages {
                    box-shadow: 0 0 0 0;
                    bottom: 0;
                    left: 0;
                    margin: 0px;
                    border-radius: 0px;
                }
            }
            .bottom {
                bottom: 3vh !important;
                cursor: pointer;
                position: absolute;
            }
            
            a.logout {
                color: red;
            }
            a.logout:hover {
                color: white;
                background: red;
            }
            .icons{
                 margin: auto;
                 width: 50%;
            }
        </style>
    </head>
    <body>
        <div class="sidenav">
          <a href="/newinterface.php?themeChange=true">Change theme</a>
          <a href="/newinterface.php?s=1">Main Chаtroom</a>
          <a href="/newinterface.php?s=2">2nd Chаtroom</a>
          <a href="/newinterface.php?s=3">Private chаtrooms</a>
          <a href="/newinterface.php?s=4">Direct Messаges</a>
          <a href="/news.html">Latest News</a></a>
          <a href="https://stats.uptimerobot.com/gPz42HqOpv">Uptime</a>
          <a class="logout" href="/newinterface.php?logout=1">Logout</a>
            <?php
            if (isset($_SESSION['chatroom']) && $_SESSION['chatroom'] !== "") {
                echo '<a class="logout" href="/newinterface.php?logout=2">Logout of private chatrooms</a>';
            }
            ?>
          <a class="bottom" onclick="window.scrollTo(0,document.body.scrollHeight);">Scroll to 
          bottom</a>
        </div>
        <div class="sidenav-mobile">
          <a href="/newinterface.php?s=1"><i class="fa-solid fa-circle-1"></i></a>
          <a href="/newinterface.php?s=2"><i class="fa-solid fa-circle-2"></i></a>
          <a href="/newinterface.php?s=3"><i class="fa-solid fa-circle-p"></i></a>
          <a href="/newinterface.php?s=4"><i class="fas fa-comments-alt"></i></a>
          <a href="/news.html"><i class="fa-solid fa-newspaper"></i></a>
          <a href="/newinterface.php?themeChange=true"><i class="fa-solid fa-circle-half-stroke"></i></a>
          <a href="https://stats.uptimerobot.com/gPz42HqOpv"><i class="fa-solid fa-circle-up"></i></a>
          <a href="/logout.php"><i style="color: red;" class="fa-solid fa-right-from-bracket"></i></a>
        </div>
        <div class="main">
            <?php
            displayContent();
            checkforThemeChange();
            ?>
        </div>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            window.scrollTo(0,document.body.scrollHeight);
            function loadLog() {
 
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#main").html(html); //Insert chat log into the #chatbox div
 
                        }
                    });
                }
            setInterval (loadLog, 2500);
        </script>
    </body>
</html>