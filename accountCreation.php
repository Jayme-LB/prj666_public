<?php
  // For debugging purposes.
  ini_set('display_errors', 1);
  error_reporting(E_ALL | E_STRICT);
  include '/home/jayme/firephp-core/lib/FirePHPCore/fb.php';
  
  require 'scripts/dbConnect.php';
  require 'scripts/selectQueries.php';
  require 'scripts/insertQueries.php';
  
  // Validate the fields upon submission.
  if ($_POST){
    $acUsername = trim($_POST["acUsername"], " \t\n\r\0\x0B"); // Remove trailing whitespace from the field.
    $acPassword = $_POST["acPassword"];
    $acPasswordConfirm = $_POST["acPasswordConfirm"];
    $acEmail = $_POST["acEmail"];
    
    $errorMsg = "";
    
    // Username field.
    if (strlen($acUsername) < 3){
      $errorMsg .= "<br><b>Your username must have a minimum of 3 characters.</b>";
    }
    
    // OPENING DATABASE CONNECTION.
    $dbConn = dbConnect(); 
    
    // Check that the username does not exist already.
    $userFound = usernameExists($dbConn, strtolower($acUsername));
    FB::log('User found status: '.$userFound);
    if ($userFound){
      $errorMsg .= "<br><b>The chosen username already exists. Please insert a new one.</b>";
    }
    FB::log('usernameExists() finished');
    
    // Password fields.
    if ($acPassword != $acPasswordConfirm){
      $errorMsg .= "<br><b>Your passwords do not match.</b>";
    }
    
    if (strlen($acPassword) < 8){
      $errorMsg .= "<br><b>Your password must have a minimum length of 8 characters.</b>";
    }
    
    // Email field
    $emailFound = emailExists($dbConn, strtolower($acEmail));
    FB::log('Email found status: '.$emailFound);
    if ($emailFound){
      $errorMsg .= "<br><b>The chosen email address is already in use by another user.</b>";
    }
    FB::log('emailExists() finished');
    
    FB::log('All fields have been checked.');
    // Create a new user account in the database when all fields are valid.
    if ($errorMsg === ""){
      FB::log('Beginning USERS insert');
      $acPassword = password_hash($acPassword, PASSWORD_DEFAULT);
      addUser($dbConn, $acUsername, $acPassword, $acEmail);
      FB::log('addUser() finished');
    }
    
    // CLOSING DATABASE CONNECTION.
    mysqli_close($dbConn);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Account Creation - Open Data Visualizer</title>
  </head>
  <body>
    <p>
      <a href="index.php">Home</a>
      <a href="login.php">Login</a>
      <a href="accountCreation.php">Create Account</a>
      <a href="user/viewUserProfile.php">View User Profile</a>
      <a href="user/editUserProfile.php">Edit User Profile</a>
    </p>
    <h1>Account Creation</h1>
    <p>All fields are required.</p>
    <form method="post" action="accountCreation.php">
      Username<br>
      <input type="text" name="acUsername" required>
      <br><br>
      Password<br>
      <input type="password" name="acPassword" required>
      <br><br>
      Confirm Password<br>
      <input type="password" name="acPasswordConfirm" required>
      <br><br>
      Email<br>
      <input type="email" name="acEmail" required>
      <br><br>
      <input type="submit" value="Submit">
    </form>
<?php
  if ($_POST){
    if (isset($errorMsg) && $errorMsg !== ""){
?>
    <p>We are unable to create an account for you due to the following: <?php echo $errorMsg ?></p>
<?php
    }
  }
?>
  </body>
</html>
