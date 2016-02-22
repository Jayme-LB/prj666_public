<?php
  // For debugging purposes.
  ini_set('display_errors', 1);
  error_reporting(E_ALL | E_STRICT);
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  
  // This function connects to the database and returns the mysqli connection.
  function dbConnect(){
    // Database connection info, which is gained from a file outside the web root directory.
    // Contains, in order: host, username, password, schema.
    $dbInfo = file('/home/jayme/files/dbinfo');
    FB::log('Grabbed DB information');
    $dbConn = mysqli_connect(trim($dbInfo[0]), // Host
      trim($dbInfo[1]), // Username
      trim($dbInfo[2]), // Password
      trim($dbInfo[3])); // Schema
    FB::log('Connecting to database');
    if (mysqli_connect_errno($dbConn)){
      printf("Database connection failed: " . mysqli_connect_error());
      FB::error('Database connection failed: "' . mysqli_connect_error());
    }
    FB::log('DB connection success!');
    return $dbConn;
  }
?>
