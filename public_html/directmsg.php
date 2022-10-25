<?php
if (isset($_POST['enter'])) {
    $text = $_POST['message'];
    $user = $_POST['user'];
    $text_message = "<div class='msgln'><span class='chat-time'>".date("d/m g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Direct Messages</title>
    <link type="text/css" rel="stylesheet" href="/style.css?v=3" />
    <script src="https://kit.fontawesome.com/049529442a.js" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
    <style>
        @media (prefers-color-scheme: dark) {
            .loginform {
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
    </style>
</head>
<body>
    <form class="loginform">
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
        </div>

        <div id="chatbox">
            <?php
            if(file_exists($_SESSION['name'].".html") && filesize($_SESSION['name'].".html") > 0){
                $contents = file_get_contents($_SESSION['name'].".html");
                echo $contents;
            }
            ?>
        </div>

    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        // jQuery Document

            function loadLog() {
                var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request

                $.ajax({
                    url: <?php  echo $_SESSION['name']; ?>+".html",
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
                    window.location = "index.php";
                }
            });
        });
    </script>
</body>
</html>

