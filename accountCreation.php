<?php
  // For debugging purposes.
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);

  $numErrors = 0;
  $errorMsg = "";

  // Validate the fields.
  if ($_POST){
    $acUsername = $_POST["acUsername"];
    $acPassword = $_POST["acPassword"];
    $acPasswordConfirm = $_POST["acPasswordConfirm"];
    $acEmail = $_POST["acEmail"];
    $acMonth = $_POST["acMonth"];
    $acDay = $_POST["acDay"];
    $acYear = $_POST["acYear"];

    // Check if password fields match.
    if($acPassword != $acPasswordConfirm){
      $numErrors++;
      $errorMsg .= "<br>Your passwords do not match.";
    }
    
    // Open database connection.
    $dbInfo = file('/home/jayme/files/dbinfo');
		$dbHost = trim($dbInfo[0]);
		$dbUser = trim($dbInfo[1]);
		$dbPass = trim($dbInfo[2]);
		$dbSchema = trim($dbInfo[3]);
    // $mysqli = mysqli_connect($dbHost, $dbUser, $dbPass, $dbSchema);
    // if (mysqli_connect_errno($mysqli)){
      // echo "Database connection failed: " . mysqli_connect_error();
    // }
    
    // Create a new user account in the database when all fields are valid.
    if ($numErrors == 0){
      
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Account Creation - Open Data Visualizer</title>
  </head>
  <body>
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
      Date of Birth<br>
      Month:
      <select id="acMonth" name="acMonth">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
      Day:
      <input type="number" min="1" max="31" name="acDay" required>
      Year:
      <input type="number" min="1900" max="<?php echo date("Y"); ?>" name="acYear" required>
      <br><br>
      <input type="submit" value="Submit">
    </form>
    <?php
      if ($numErrors == 0){
        echo $errorMsg;
      }
    ?>
  </body>
</html>
