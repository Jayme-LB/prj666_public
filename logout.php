<?php
  // For debugging purposes.
  include '/home/jayme/firephp-core/lib/FirePHPCore/fb.php';
  
  include 'scripts/sessions.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login - Open Data Visualizer</title>
  </head>
  <body>
<?php
  if (empty($_SESSION['LoggedIn'])){ // START NO SESSION HTML
?>
    <p>You are not logged in! <a href="login.php">Click here</a> to login,
    <a href="accountCreation">click here</a> to create an account, or 
    <a href="index.php">click here</a> to return to the home page.</p>
<?php
  }else{ // END NO SESSION HTML / START SESSION HTML
    $_SESSION = array();
    session_destroy();
?>
    <p>You are now logged out. <a href="index.php">Click here</a> to return to the home page.</p>
<?php
  } // END SESSION HTML
?>
  </body>
</html>