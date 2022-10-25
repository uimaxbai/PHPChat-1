<?php
session_start();
?>

<!DOCTYPE html>
<html lang=en>
  <head>
    <title>PHPChаt: A no-faff chat room</title>
    <meta charset="utf-8" />
    <meta name="description" content="PHPChat: A no-faff simple chatroom" />
    <link type="text/css" rel="stylesheet" href="/style.css?v=3" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="fspro.js" crossorigin="anonymous"></script>
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
      .warning {
          color: red;
      }
    </style>
  </head>
  <body>
  <div class="logout">
      <a href="logout.php"><i class="fas fa-sign-out-alt" ></i> Logout</a>
</div>
    <img class="logo" src="/logo.png" onclick="location.href='/index.php';">
  <h1 class="warning">THIS IS AN OLD PAGE. IT IS PURELY KEPT HERE FOR HISTORICAL PUROPSES AND IS NOT SUPPORTED, AS YOU CAN SEE BY THE MANY 404 PAGES. FOR THE NEW INTERFACE, CLICK <a href="/newinterface.php">HERE</a>.</h1>
    <div class="chat1"><br>

      <button type="submit" onclick="location.href='/chat.php';" class="button"><span><b>Mаin Chаtroom</b></span></button>
    </div>
    <div class="chat2"><br>

      <button type="submit" class="button" onclick="location.href='/chat2.php';"><span><b>Secondаry Chаtroom</b></span></button>
    </div>
  <div class="dms"><br>

      <button type="submit" class="button" onclick="location.href='/directmsg.php';"><span><b>Direct Messages
                  <?php
                  if (file_exists($_SESSION['name'].".html")) {
                      echo '(1)';
                  }
                  ?></b></span></button>
  </div>
    <div class="pp"><br>

      <button type="submit" class="button" onclick="location.href='/privacy-policy.html';"><span><b>Privаcy Policy</b></span></button>
    </div>
    <div class="staus"><br>

      <button type="submit" class="button" onclick="location.href='/status.html';"><span><b>Uptime</b></span></button>
    </div>
    <div class="test"><br>
      <button type="submit" class="button" onclick="location.href='/privateroom.php';"><span><b>Private Chаtrooms (reRELEASED)!</b></span></button>
     <div class="news"><br>
      <button type="submit" class="button" onclick="location.href='/news.html';"><span><B>News</B></span></button><br><br>
      <iframe src="news.html" title="News"height="500" width="800" ></iframe>
      <br>
      <br>
      
     
  </body>
</html>