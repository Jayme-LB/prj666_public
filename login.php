<?php
  // For debugging purposes.
  ini_set('display_errors', 1);
  error_reporting(E_ALL | E_STRICT);
  include '/home/jayme/firephp-core/lib/FirePHPCore/fb.php';
  
  require 'scripts/dbConnect.php';
  require 'scripts/selectQueries.php';
  include 'scripts/sessions.php';

  // Validate the fields upon submission.
  if ($_POST){
    $loginUsername = trim($_POST["loginUsername"], " \t\n\r\0\x0B"); // Remove trailing whitespace from the field.
    $loginPassword = $_POST["loginPassword"];
    
    $errorMsg = "";
    
    // OPENING DATABASE CONNECTION.
    $dbConn = dbConnect();
    
    // Check that the username exists in the database.
    $userFound = usernameExists($dbConn, strtolower($loginUsername));
    FB::log('User found status: '.($userFound ? 'True' : 'False'));
    if ($userFound){
      // Check that the password is correct for the user.
      $isValid = passwordExists($dbConn, $loginUsername, $loginPassword);
      FB::log('Login valid? '.($isValid ? 'True' : 'False'));
      if ($isValid){ //TODO Creating PHP sessions for managing user login.
        FB::log('Login success! Setting session variables...');
        $_SESSION['LoggedIn'] = true;
        $_SESSION['Username'] = $loginUsername;
        $_SESSION['UserId'] = getUserId($dbConn, $loginUsername);
        FB::info('LoggedIn: '.$_SESSION['LoggedIn'].', Username: '.$_SESSION['Username'].', UserId: '.$_SESSION['UserId']);
      }else{
        $errorMsg = "<b>Your password is incorrect. Please try again.</b>";
      }
    }else{
      $errorMsg = "<b>That username was not found. Please select an existing username.</b>";
    }
    
    // CLOSING DATABASE CONNECTION.
    mysqli_close($dbConn);
  }
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
    <p>
      <a href="index.php">Home</a>
      <a href="login.php">Login</a>
      <a href="accountCreation.php">Create Account</a>
      <a href="user/viewUserProfile.php">View User Profile</a>
      <a href="user/editUserProfile.php">Edit User Profile</a>
    </p>
    <h1>Login</h1>
    <form method="post" action="login.php">
        Username<br>
        <input type="text" name="loginUsername" required><br>

        Password<br>
        <input type="password" name="loginPassword" required><br>

        <input type="submit" value="Login">
    </form>
    <p>
      <a href="accountCreation.php">Register</a>
      <!-- <a href="resetPassword.php">Forgot Password?</a> -->
    </p>
<?php
    if ($_POST){
      if (isset($errorMsg) && $errorMsg !== ""){
        echo $errorMsg;
      }
    }
  }else{ // END NO SESSION HTML / START SESSION HTML
?>
  <p>You are already logged in! 
  <a href="logout.php">Click here</a> to logout or <a href="index.php">click here</a> to return to the home page.</p>
<?php
  } // END SESSION HTML
?>
  </body>
</html>
