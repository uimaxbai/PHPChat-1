<?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
    $date_now = time(); //current timestamp
    $file = fopen("ls2.txt", "w+");
    $last_message = intval(fread($file, filesize("ls2.txt")));
    if ($date_now > $last_message) {
      $date = "<p class='date'>".date("l d/m/y")."</p>";
      file_put_contents("log2.html", $date, FILE_APPEND | LOCK_EX);
    }
    $text_message = "<div class='msgln'><span class='chat-time'>".date("H:i")."</span> <b class='user-name'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("log2.html", $text_message, FILE_APPEND | LOCK_EX);
    $txt = strval($date_now);
    fwrite($file, $txt, filesize("ls2.txt"));
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <title></title>
    <meta name="robots" content="noindex">
  </head>
</html>