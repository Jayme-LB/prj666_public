<?php
  // For debugging purposes.
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);

  require_once 'scripts/dbConnect.php';
  require_once 'scripts/selectQueries.php';
  require_once 'scripts/insertQueries.php';
  
  // Validate the fields upon submission.
  if ($_POST){
    $acUsername = trim($_POST["acUsername"], " \t\n\r\0\x0B"); // Remove trailing whitespace from the field.
    $acPassword = $_POST["acPassword"];
    $acPasswordConfirm = $_POST["acPasswordConfirm"];
    $acEmail = $_POST["acEmail"];
    $acMonth = $_POST["acMonth"];
    $acDay = $_POST["acDay"];
    $acYear = $_POST["acYear"];
    
    $errorMsg = "";
    
    // Username field.
    if (strlen($acUsername) < 3){
      $errorMsg .= "<br><b>Your username must have a minimum of 3 characters.</b>";
    }
    
    // Check that the username does not exist already.
    $dbConn = dbConnect();
    if (usernameExists($dbConn, $acUsername)){
      $errorMsg .= "<br><b>The chosen username already exists. Please insert a new one.</b>";
    }
    
    
    // Password fields.
    if ($acPassword != $acPasswordConfirm){
      $errorMsg .= "<br><b>Your passwords do not match.</b>";
    }
    
    if (strlen($acPassword) < 8){
      $errorMsg .= "<br><b>Your password must have a minimum length of 8 characters.</b>";
    }
    
    // Create a new user account in the database when all fields are valid.
    if ($errorMsg !== ""){
      $dbMsg = "Starting connection";
      $dob = $acYear."-".$acMonth."-".$acDay; // Date of Birth.
      $dbConn = dbConnect();
      addUser($acUsername, password_hash($acPassword, PASSWORD_DEFAULT), $acEmail, $dob);
      mysqli_close($dbConn);
      $dbMsg = "The connection should have gone through...";
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
    <p>
      <a href="/~jayme/index.php">Home</a>
      <a href="/~jayme/signin.php">Sign In</a>
      <a href="/~jayme/accountCreation.php">Create Account</a>
      <a href="/~jayme/user/viewUserProfile.php">View User Profile</a>
      <a href="/~jayme/user/editUserProfile.php">Edit User Profile</a>
    </p>
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
      <select id="acMonth" name="acMonth" onchange="maxDay()">
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
  if ($_POST){
    // Below is for debugging purposes.
    echo "<b>Username:</b>".$acUsername."<br>";
    echo "<b>Password:</b>".password_hash($acPassword, PASSWORD_DEFAULT)."<br>";
    echo "<b>Confirm Password:</b>".$acPasswordConfirm."<br>";
    echo "<b>Email:</b>".$acEmail."<br>";
    echo "<b>DOB Month:</b>".$acMonth."<br>";
    echo "<b>DOB Day:</b>".$acDay."<br>";
    echo "<b>DOB Year:</b>".$acYear."<br>";
    
    if (isset($errorMsg) && $errorMsg !== ""){
      echo "<p>We are unable to create an account because of the following:"
      .$errorMsg
      ."</p>";
    }elseif (isset($dbMsg) && $dbMsg !== ""){
      echo $dbMsg;
    }
  }
?>
  </body>
</html>
