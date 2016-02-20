<?php
  // For debugging purposes.
  ini_set('display_errors', 1);
  error_reporting(E_ALL | E_STRICT);
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  // This function inserts a new account into the database.
  // All arguments are assumed to have already been validated.
  function addUser($dbConn, $username, $password, $email){
    // Add user to USERS table.
    $dbQuery = "INSERT INTO USERS(Username, First_name, Last_name, Email, Status, About, Date_joined, Password)"
    ."VALUES('".$username."', '', '', '".$email."', 'active', '', CURDATE(), '".$password."')";
    
    FB::info('addUser() query:'.$dbQuery);
    if ($dbResults = mysqli_query($dbConn, $dbQuery)){
      FB::log('USERS insert success! (I think)');
    }else{
      FB::error('USERS insert failed!');
    }
    
    $userId = mysqli_insert_id($dbConn); // ID of the latest created user.
    FB::info('New User ID: '.$userId);
    
    // Add user role for newly created user into USER_ROLES table.
    $dbQuery = "INSERT INTO USER_ROLES(User_Id, Role_Id)"
    ."VALUES(".$userId.", 1)";
    
    if ($dbResults = mysqli_query($dbConn, $dbQuery)){
      FB::log('USER_ROLES insert success! (I think)');
    }else{
      FB::error('USER_ROLES insert failed!');
    }
    
    // Add default avatar for newly created user into IMAGES table.
    $avatar = file('images/default_avatar.png'); // Default avatar for new users.
    $dbQuery = "INSERT INTO IMAGES(Description, Image, User_Id) "
    ."VALUES('test', '".$avatar."', ".$userId.")";
    
    if ($dbResults = mysqli_query($dbConn, $dbQuery)){
      FB::log('IMAGES insert success! (I think)');
    }else{
      FB::error('IMAGES insert failed!');
    }
  } 
?>