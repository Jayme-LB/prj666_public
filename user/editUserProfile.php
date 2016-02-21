<?php
  // For debugging purposes.
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);

  if ($_POST){
    
  }
  ?>
<!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <title>Edit User Profile - Open Data Visualizer</title>
  </head>
  <body>
    <p>
      <a href="index.php">Home</a>
      <a href="login.php">Login</a>
      <a href="accountCreation.php">Create Account</a>
      <a href="user/viewUserProfile.php">View User Profile</a>
      <a href="user/editUserProfile.php">Edit User Profile</a>
    </p>
    <h1>Edit Profile Information</h1>
    <form method="post" action="editUserProfile.php">
      Select an image to upload as your avatar.<br>
      <input type="file" name="eupAvatar" id="avatar">
      <br><br>
      Current Password<br>
      <input type="password" name="eupCurrentPassword">
      <br><br>
      New Password<br>
      <input type="password" name="eupNewPassword">
      <br><br>
      Confirm New Password<br>
      <input type="password" name="eupNewPasswordConfirm">
      <br><br>
      Email<br>
      <input type="email" name="eupEmail">
      <br><br>
      Phone Number<br>
      <input type="text" name="eupPhoneNumber">
      <br><br>
      About Me<br>
      <textarea name="eupAboutMe" cols="40" rows="5" wrap="physical"></textarea>
      <br><br>
      <input type="submit" value="Save Changes">
    </form>
  </body>
</html>