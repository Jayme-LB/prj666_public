<?php
  // For debugging purposes.
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  include '/home/jayme/firephp-core/lib/FirePHPCore/fb.php';
  
  require 'scripts/dbConnect.php';
  require 'scripts/selectQueries.php';

  // OPENING DATABASE CONNECTION.
  $dbConn = dbConnect();
  
  // CLOSING DATABASE CONNECTION.
  mysqli_close($dbConn);
?>
<!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <title>View User Profile - Open Data Visualizer</title>
  </head>
  <body>
    <p>
      <a href="index.php">Home</a>
      <a href="login.php">Login</a>
      <a href="accountCreation.php">Create Account</a>
      <a href="user/viewUserProfile.php">View User Profile</a>
      <a href="user/editUserProfile.php">Edit User Profile</a>
    </p>
<?php
  if (isset($_GET["id"])){
?>
    <h1>View User Profile</h1>
    <p>To be implemented</p>
<?php
  }else{
?>
    <p>You are unable to access this page without an "id" in the URL.</p>
<?php
  }
?>
  </body>
</html>