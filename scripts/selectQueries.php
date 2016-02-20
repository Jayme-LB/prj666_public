<?php
  // For debugging purposes.
  ini_set('display_errors', 1);
  error_reporting(E_ALL | E_STRICT);
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  
  // This function finds the given username in the database (in lowercase) and returns true if it exists.
  function usernameExists($dbConn, $username){
    $isFound = true;
    $dbQuery = "SELECT Username FROM USERS WHERE Username = '".$username."' LIMIT 1";
    
    FB::info('usernameExists() query:'.$dbQuery);
    if ($dbRows = mysqli_query($dbConn, $dbQuery)){
      FB::log('USER select success!');
      $dbResult = mysqli_num_rows($dbRows);
      FB::info('mysqli_num_rows: '.$dbResult);
      if ($dbResult > 0){
        FB::error('Username already in database.');
      }else{
        FB::log('Username not found in database. New username OK!');
        $isFound = false;
      }
    }else{
      FB::error('USER select failed!');
    }
    
    return $isFound;
  }
  
  // This function finds the given email in the database (in lowercase) and returns true if it exists.
  function emailExists($dbConn, $email){
    $isFound = true;
    $dbQuery = "SELECT Email FROM USERS WHERE Email = '".$email."' LIMIT 1";
    
    FB::info('emailExists() query:'.$dbQuery);
    if ($dbRows = mysqli_query($dbConn, $dbQuery)){
      FB::log('USER select success!');
      $dbResult = mysqli_num_rows($dbRows);
      FB::info('mysqli_num_rows: '.$dbResult);
      if ($dbResult > 0){
        FB::error('Email already in database.');
      }else{
        FB::log('Email not found in database. Email OK!');
        $isFound = false;
      }
    }else{
      FB::error('USER select failed!');
    }
    
    return $isFound;
  }
  
  // This function gets the password of the given user and returns true if it matches the database.
  function isLoginValid($dbConn, $username, $password){
    $isValid = false;
    $dbQuery = "SELECT Username, Password "
    ."FROM USERS "
    ."WHERE Username = '".$username."' AND Password = '".$password."'";
    
    //TODO Research how to validate a hashed password from the database.
    // $dbResults = mysqli_query($dbQuery);
    
    // if (mysqli_num_rows($dbResults) > 0){
      // $isFound = true;
    // }
    
    return $isValid;
  }
  
  // This function returns the values needed to display the View User Profile page.
  function getViewUserProfile($dbConn, $userId){
    $dbQuery = "SELECT u.Username, u.First_name, u.Last_name, u.About, u.Date_joined, i.Image "
    ."FROM USERS u LEFT JOIN IMAGES i "
    ."ON u.Id = i.UserId "
    ."WHERE u.UserId = ".$userId;
    
    $dbResults = mysqli_query($dbConn, $dbQuery);
  }
  
  // This function performs a Viz-related search.
  // function searchViz($dbConn, $queryString) {
  	// $dbQuery = "SELECT * FROM VIZ WHERE Viz_name LIKE '".$queryString."%'";

  	// $dbRows = mysqli_query($dbConn, $dbQuery); 
  	// $rows = array();

  	// while($r = mysqli_fetch_assoc($dbRows)) {
  		// $userQuery = "Select Username from USERS where Id='".$r['User_id']."' ";
  		// $userRows = mysqli_query($dbConn, $userQuery);
  		// $user;
  		// while($y = mysqli_fetch_assoc($userRows)) {
  			// $user = $y;
  		// }
  		// $rows[] = array('data' => $r, 'userName' => $user);
  	// }	
  	
  	// $json = json_encode($rows);

  	// return $json;
  // }
?>