<?php

  if(isset($_POST["time"]) && isset($_POST["name"]) && isset($_POST["message"])){
    echo saveMessage($_POST["time"],$_POST["name"],$_POST["message"]);
  }

  function saveMessage($time, $name, $message) {

    if(!file_exists('log/chat_log.xml')) {
        $filehandler = fopen('log/chat_log.xml','w');
        fwrite($filehandler, "<chat>\n\n<chat>");
        fclose($filehandler);
    }

    $post = "\t<post>\n\t\t<time>$time</time>\n\t\t<name>$name</name>\n\t\t<message>$message</message>\n\t</post>\n</chat>";

    $filehandler = fopen('log/chat_log.xml','c');
    fseek($filehandler, -7, SEEK_END);
    fwrite($filehandler,$post);
    fclose($filehandler);
    return "Message saved: $post";
  }

?>