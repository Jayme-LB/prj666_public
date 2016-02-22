<?php
  // For debugging purposes.
  ini_set('display_errors', 1);
  error_reporting(E_ALL | E_STRICT);
  require '/home/jayme/firephp-core/lib/FirePHPCore/fb.php';
  
  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home Page - Open Data Visualizer</title>
  </head>
  <body>
    <p>
      <a href="index.php">Home</a>
      <?php
        if (!empty($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']){
      ?>
      <a href="logout.php">Logout of <?php echo $_SESSION['Username'] ?></a>
      <?php
        }else{
      ?>
      <a href="login.php">Login</a>
      <?php
        }
      ?>
      <a href="accountCreation.php">Create Account</a>
      <a href="user/viewUserProfile.php">View User Profile</a>
      <a href="user/editUserProfile.php">Edit User Profile</a>
    </p>
    <h1>Welcome to the Open Data Visualizer!</h1>
    <p><b>
      Our goal is to provide statistical data visualizations based on the Government of
      Canada's <a href="http://open.canada.ca/en">Open Data Portal</a>.
    </b></p>
  </body>
</html>
