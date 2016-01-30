<?php
  // For debugging purposes.
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);

  // Validate the fields.
  if ($_POST){
    $acUsername = trim($_POST["acUsername"], " \t\n\r\0\x0B");
    $acPassword = $_POST["acPassword"];
    $acPasswordConfirm = $_POST["acPasswordConfirm"];
    $acEmail = $_POST["acEmail"];
    $acMonth = $_POST["acMonth"];
    $acDay = $_POST["acDay"];
    $acYear = $_POST["acYear"];
    
    $errorMsg = "";
    $dbErrorMsg = "";
    
    // Check if password fields match.
    if($acPassword != $acPasswordConfirm){
      $errorMsg .= "<br><b>Your passwords do not match.</b>";
    }
    
    // Create a new user account in the database when all fields are valid.
    if ($errorMsg !== ""){
      // Open database connection.
      $dbInfo = file('/home/jayme/files/dbinfo');
      $dbHost = trim($dbInfo[0]);
      $dbUser = trim($dbInfo[1]);
      $dbPass = trim($dbInfo[2]);
      $dbSchema = trim($dbInfo[3]);
      $dbErrorMsg = "<br>You should only see this when all fields are good.";
      $mysqli = mysqli_connect($dbHost, $dbUser, $dbPass, $dbSchema);
      if (mysqli_connect_errno($mysqli)){
        $dbErrorMsg = "Database connection failed: " . mysqli_connect_error();
      }
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
        echo "<b>Username:</b>".$acUsername."<br>";
        echo "<b>Password:</b>".$acPassword."<br>";
        echo "<b>Confirm Password:</b>".$acPasswordConfirm."<br>";
        echo "<b>Email:</b>".$acEmail."<br>";
        echo "<b>DOB Month:</b>".$acMonth."<br>";
        echo "<b>DOB Day:</b>".$acDay."<br>";
        echo "<b>DOB Year:</b>".$acYear."<br>";
        
        if ($errorMsg !== ""){
          echo $errorMsg;
        }
        if ($dbErrorMsg !== ""){
          echo $dbErrorMsg;
        }
      }
    ?>
  </body>
</html>
