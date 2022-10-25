<?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['usermsg'];
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
        $text = "!?*@$;!";
    }
     
    $text_message = "<div class='msgln'><span class='chat-time'>".date("d/m g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="robots" content="noindex">
  </head>
</html>