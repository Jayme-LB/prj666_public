<?php
  session_start();

  if (empty($_SESSION['LoggedIn'])){
    FB::log('LoggedIn session empty.');
  }else{
    FB::log('LoggedIn session not empty. Value: '.$_SESSION['LoggedIn']);
  }

  if (empty($_SESSION['Username'])){
    FB::log('Username session empty.');
  }else{
    FB::log('Username session not empty. Value: '.$_SESSION['Username']);
  }

  if (empty($_SESSION['UserId'])){
    FB::log('UserId session empty.');
  }else{
    FB::log('UserId session not empty. Value: '.$_SESSION['UserId']);
  }
?>
