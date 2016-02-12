<?php
  // For debugging purposes.
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  
  // Database connection info, which is gained from a file outside the web root directory.
  // Contains, in order: host, username, password, schema, and port.
  $DBINFO = file('/home/jayme/files/dbinfo');
  $DBCONN = ""; // Database connection.
  
  // This function connects to the database.
  function dbConnect(){
    global $DBINFO, $DBCONN;
  
    if ($DBCONN === ""){
      $DBCONN = mysqli_connect(trim($DBINFO[0]), // Host
        trim($DBINFO[1]), // Username
        trim($DBINFO[2]), // Password
        trim($DBINFO[3])); // Database
      
      if (mysqli_connect_errno($DBCONN)){
        printf("Database connection failed: " . mysqli_connect_error());
      }
    }
  }
  
  // This function closes the database connection.
  function dbClose(){
    global $DBCONN;
	
    if ($DBCONN !== ''){
      mysqli_close($DBCONN);
    }
  }
?>
