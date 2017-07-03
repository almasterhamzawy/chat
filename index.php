<?php

require('includes/config.php');
require('includes/generalFunction.php');
require("includes/chat.php");


if(count($_POST)>0){

    $name = $_POST['name'];
    $message = $_POST['message'];


    $user = new chat();

   if( $user->addMessage($name,$message)){

    echo "<audio src='assets/sound/facebook.mp3' autoplay></audio>";

   }
}


$user = new chat();
$messages = $user->getMessages();


include('template/index.html');
