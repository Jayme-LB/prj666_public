<?php
  // For debugging purposes.
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  
  if ($_POST){
    $siUsername = $_POST["siUsername"];
    $siPassword = $_POST["siPassword"];
    
    
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sign In - Open Data Visualizer</title>
  </head>
  <body>
    <h1>Sign In</h1>
    <form method="post" action="signin.php">
        Username<br>
        <input type="text" name="siUsername" required><br>

        Password<br>
        <input type="password" name="siPassword" required><br>

        <input type="submit" value="Login">
    </form>
    <p>
      <a href="accountCreation.php">Register</a>
      <a href="resetPassword.php">Forgot Password?</a>
    </p>
  </body>
</html>
