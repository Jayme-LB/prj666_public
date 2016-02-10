<?php
  // For debugging purposes.
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  
  // This function finds the given username string in the database and returns true if it exists.
  function usernameExists($username){
    $isFound = false;
    $dbQuery = "SELECT Username"
    ."FROM USERS"
    ."WHERE Username = '".$username."';";
    
    $dbResults = mysqli_query($dbQuery);
    
    if (mysqli_num_rows($dbResults) > 0){
      $isFound = true;
    }
    
    return $isFound;
  }
  
  // This function gets the password of the given user and returns true if it matches the database.
  function isLoginValid($username, $password){
    $isValid = false;
    $dbQuery = "SELECT Username, Password"
    ."FROM USERS"
    ."WHERE Username = '".$username."' AND Password = '".$password."'";
    
    //TODO Research how to validate a hashed password from the database.
    // $dbResults = mysqli_query($dbQuery);
    
    // if (mysqli_num_rows($dbResults) > 0){
      // $isFound = true;
    // }
    
    return $isValid;
  }
  
  // This function returns the values needed to display the View User Profile page.
  function getViewUserProfile($userId){
    $dbQuery = "SELECT u.Username, u.First_name, u.Last_name, u.About, u.Date_joined, i.Image"
    ."FROM USERS u LEFT JOIN IMAGES i"
    ."ON u.Id = i.UserId"
    ."WHERE u.UserId = ".$userId;
    
    $dbResults = mysqli_query($dbQuery);
  }
?>