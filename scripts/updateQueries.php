<?php
  // For debugging purposes.
  ini_set('display_errors', 1);
  error_reporting(E_ALL | E_STRICT);
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  
  // This function updates the user based on the fields in Edit User Profile.
  // All arguments are assumed to have already been validated.
  function updateUser($userId, $image, $password, $email, $phone, $about){
    // TODO
    // $dbQuery = "UPDATE USERS SET ";
  }
?>