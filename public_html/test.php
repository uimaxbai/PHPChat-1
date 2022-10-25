<form name="message" action="postmsg.php">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>
        </div>
      <?php
              echo $_SESSION['usermsg'];
      ?>