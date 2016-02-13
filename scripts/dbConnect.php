<?php
  // For debugging purposes.
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
    
  // This function connects to the database and returns the mysqli connection.
  function dbConnect(){
    // Database connection info, which is gained from a file outside the web root directory.
    // Contains, in order: host, username, password, schema.
    $dbInfo = file('/home/jayme/files/dbinfo');
  
    $dbConn = mysqli_connect(trim($dbInfo[0]), // Host
      trim($dbInfo[1]), // Username
      trim($dbInfo[2]), // Password
      trim($dbInfo[3])); // Database
      
    if (mysqli_connect_errno($dbConn)){
      printf("Database connection failed: " . mysqli_connect_error());
    }
    
    return $dbConn;
  }
  
?>
